<?php

namespace App\Http\Livewire\Client;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Broker;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClientForm extends BasicForm
{
    use WithFileUploads ;

    protected $rules = [
        'type' => 'required|in:individual,company',
        'name' => 'required_if:type,individual|string',
        'card_id' => 'required_if:type,individual|numeric',
        'card_image' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        'company_name' => 'nullable|required_if:type,company|string',
        'register_number' => 'nullable|required_if:type,company|numeric',
        'agent_name' => 'nullable|required_if:type,company|string',
        'register_image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        'phone' => 'required|numeric',
        'email' => 'nullable|email',
        'branch_id' => 'required|exists:branches,id',
        'broker_id' => 'nullable|exists:brokers,id',
        'letter_head' => 'nullable|string'
    ];

    public $name ,$type = 'individual' ,$card_id ,$card_image,$card_image_path,$company_name ,$agent_name, $register_number,$register_image ,$register_image_path
    ,$phone,$email , $branch_id , $broker_id , $letter_head;
    public $client ;


    public function mount($id = null){
        if ($id) {
            $this->client = Client::find($id) ;
            $this->type = $this->client->type ;
            $this->name = $this->client->name ;
            $this->card_id = $this->client->card_id ;
            $this->card_image_path = $this->client->card_image ;
            $this->company_name = $this->client->name ;
            $this->agent_name = $this->client->agent_name ;
            $this->register_number = $this->client->register_number ;
            $this->register_image_path = $this->client->register_image ;
            $this->phone = $this->client->phone ;
            $this->email = $this->client->email ;
            $this->branch_id = $this->client->branch_id ;
            $this->broker_id = $this->client->broker_id ;
            $this->letter_head = $this->client->letter_head ;
            $this->title = 'edit';
            $this->button = 'update';
            $this->color = 'primary';
        }
    }


    public function render()
    {
        $service = new ClientService();
        $clients = $service->getClients();
        $branches = $service->getBranches();
        $brokers = Broker::pluck('name', 'id')->toArray();
        return view('livewire.client.client-form',compact('clients','branches','brokers'));
    }

    public  function save()
    {
        $validated =  $this->validate();
        $validated['from'] = 'dashboard';
//        $service = new ClientService();
        if ($this->client) {
            if ($validated['type'] == 'company') {
                $validated['name'] = $validated['company_name'];
                $validated['card_id'] = null;
                $validated['card_image'] = null;
                if (!empty($validated['register_image'])) {
                    $validated['register_image'] = uploadFile($this->register_image, "clients",$this->client->id,'register_image');
                } else {
                    $validated = Arr::except($validated, array('register_image'));
                }
            } else {
                $validated['company_name'] = null;
                $validated['register_number'] = null;
                $validated['agent_name'] = null;
                $validated['register_image'] = null;
                if (!empty($validated['card_image'])) {
                    $validated['card_image'] = uploadFile($this->card_image, "clients",$this->client->id,'card_image',true);
                } else {
                    $validated = Arr::except($validated, array('card_image'));
                }
            }
            $this->client->update($validated);
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success', 'message' => __('message.updated', ['model' => __('names.client')])]);
        }else{
            $client =  Client::create($validated);
            if (!empty($validated['card_image'])) {
                $validated['card_image'] = uploadFile($this->card_image, "clients",$client->id,'card_image');
                $client->update(['card_image'=>$validated['card_image']]);
            }elseif(!empty($validated['register_image'])){
                $validated['register_image'] = uploadFile($this->register_image, "clients",$client->id,'register_image');
                $client->update(['register_image'=>$validated['register_image']]);
            }
            $user =auth()->user() ;
            activity()
                ->performedOn($client)
                ->causedBy($user)
                ->withProperties(['card_image' =>  $validated['card_image']])
                ->event('updated')
                ->useLog($user->name)
                ->log('Client Has been Updated');
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.client')])]);
        }

        $this->reset();
        return redirect()->route('admin.clients.index')->with('success', __('message.updated',['model'=>__('names.client')]));
    }

}
