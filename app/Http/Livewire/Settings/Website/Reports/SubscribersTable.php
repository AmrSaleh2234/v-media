<?php

namespace App\Http\Livewire\Settings\Website\Reports;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\CMS\Subscriber;
use App\Services\CMS\SubscribeService;

class SubscribersTable extends BasicTable
{
    public function render()
    {
        $service = new SubscribeService();
        return view('livewire.settings.website.reports.subscribers-table',[
            'subscribers' => $service->search($this->search)
//                ->confirmed()
                ->when($this->start_date,function ($query){
                    $query->where('created_at','>=',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at','<=',$this->end_date);
                })
//                ->when( !empty($this->status_id)   ,function ($query){
//                    $query->where('status_id','>=',$this->status_id);
//                })
//                ->select(['id','title'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }

    public function toggle($id){
        $subscriber = Subscriber::find($id);
        $subscriber->active = !$subscriber->active ;
        $subscriber->save();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.subscriber')])]);
        return ;
    }

}
