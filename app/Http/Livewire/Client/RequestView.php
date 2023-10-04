<?php

namespace App\Http\Livewire\Client;

use App\Http\Livewire\Basic\Modal;
use App\Models\Client;
use App\Models\ClientRequest;
use App\Models\Status;
use Livewire\Component;

class RequestView extends Modal
{
    protected $rules = [
        'clientRequest.status_id' => 'required|exists:statuses,id',
        'clientRequest.note' => 'string'
    ];

    public $clientRequest;
    public $clientRequest_id;
    public $statues;
    public $Oldnote;
    public function mount($requestId) {
        $this->clientRequest_id = $requestId;
        $this->clientRequest = ClientRequest::whereId($requestId)->first();
        $this->statues = Status::where("type",'requests')->pluck('name', 'id')->toArray();
        $this->Oldnote = $this->clientRequest->note;
    }

    public function updatedclientRequestStatusId($data) {
        if($data == 1) {
            $this->clientRequest->note = "";
        }else{
             $this->clientRequest->note =  $this->Oldnote;
        }
    }

    public function save() {
        $validated = $this->validate();
        $this->clientRequest->save();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.client-request')])]);
        $statusId = Status::where("type",'requests')->where('name','accepted')->value('id');
        $this->clientRequest = ClientRequest::whereId($this->clientRequest_id)->first();
        if ($validated['clientRequest']['status_id'] == $statusId){

            $data = $this->clientRequest->toArray();
            $data['client_request_id'] = $data['id'] ;
                unset($data['id']);
                if ($data['type'] == 'company'){
                    Client::updateOrCreate(['register_number'=>$data['register_number']],$data);
                }else{
                    Client::updateOrCreate(['card_id'=>$data['card_id']],$data);
                }
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.client')])]);
        }

        $this->clientRequest = ClientRequest::whereId($this->clientRequest_id)->first();

        $this->close("changeStatus");

    }

    public function render()
    {
        return view('livewire.client.request-view');
    }
}
