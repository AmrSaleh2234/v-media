<?php

namespace App\Http\Livewire\Client;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Status;
use App\Services\ClientRequestService;
use App\Services\ClientService;
use Livewire\Component;

class RequestsTable extends BasicTable
{

    protected $listeners = ['confirmDelete'];
    public function render()
    {
        $service = new ClientRequestService();
        return view('livewire.client.requests-table',[
            'clients' => $service->search($this->search)
                ->with('status','branch')
                ->when($this->start_date,function ($query){
                    $query->where('created_at','>=',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at','<=',$this->end_date);
                })
                ->when( !empty($this->status_id)   ,function ($query){
                    $query->where('status_id','>=',$this->status_id);
                })
//                ->where('from','!=','dashboard')
                ->select(['id','name','phone','email','card_id','branch_id','status_id','note'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
            'statuses' => Status::where('type','requests')->get(['id','name'])
        ]);
    }
}
