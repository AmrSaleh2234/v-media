<?php

namespace App\Http\Livewire\Broker;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Broker;
use App\Services\BrokerService;
use Livewire\Component;

class BrokerTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];
    public function render()
    {
        $service = new BrokerService();
        return view('livewire.broker.broker-table',[
            'brokers' => $service->search($this->search)
//                ->with('broker','branch','status')
//                ->select(['id','name','phone','email','card_id','branch.name'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }

    public function confirmDelete($id)
    {
        // Perform the deletion action
        $broker =  Broker::findOrFail($id);
        if ($broker->clients()->exists()){
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'error',  'message' =>__('message.still-has',['model'=>__('names.broker'),'relation'=>__('names.clients')])]);
            return ;
        }

        $broker->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.broker')])]);
        // Refresh the component to reflect the updated data

        $this->emitSelf('$refresh');
    }
}
