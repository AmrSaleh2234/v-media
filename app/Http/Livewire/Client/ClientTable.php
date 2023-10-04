<?php

namespace App\Http\Livewire\Client;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Client;
use App\Models\Status;
use App\Services\ClientService;
use Livewire\Component;

class ClientTable extends BasicTable
{

    protected $listeners = ['confirmDelete'];
    public function render()
    {
        $service = new ClientService();
        return view('livewire.client.client-table',[
            'clients' => $service->search($this->search)
//                ->confirmed()
                ->with('broker','status','branch')
                ->when($this->start_date,function ($query){
                    $query->where('created_at','>=',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at','<=',$this->end_date);
                })
                ->when( !empty($this->status_id)   ,function ($query){
                    $query->where('status_id','>=',$this->status_id);
                })
                ->select(['id','name','phone','email','card_id','branch_id','broker_id','status_id'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
            'statuses' => Status::where('type','client')->get(['id','name'])
         ]);
    }

    public function confirmDelete($id)
    {
        // Perform the deletion action
       $client =  Client::withCount('projects')->whereId($id)->first();
       if ($client->projects_count > 0){
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error',  'message' =>__('message.still-has',['model'=>__('names.client'),'relation'=>__('names.projects')])]);
       return ;
       }
            $client->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.client')])]);
        // Refresh the component to reflect the updated data

        $this->emitSelf('$refresh');
    }

}
