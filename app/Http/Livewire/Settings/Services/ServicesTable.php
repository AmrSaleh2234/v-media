<?php

namespace App\Http\Livewire\Settings\Services;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\CMS\Service;
use App\Services\CMS\ServiceService;
use Livewire\Component;

class ServicesTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];

    public function render()
    {
        $service = new ServiceService();
        return view('livewire.settings.services.services-table',[
            'services' => $service->search($this->search)
//                ->confirmed()
                ->with('category')
                ->when($this->start_date,function ($query){
                    $query->where('created_at','>=',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at','<=',$this->end_date);
                })
//                ->when( !empty($this->status_id)   ,function ($query){
//                    $query->where('status_id','>=',$this->status_id);
//                })
//                ->select(['id','name','main_image'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }
    public function confirmDelete($id)
    {
        $service = Service::find($id);
        if ($service->app) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.service'),'relation'=>__('names.application')])]);
            return ;
        } elseif($service->website) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.service'),'relation'=>__('names.website')])]);
            return ;
        }elseif($service->companyProjects()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.service'),'relation'=>__('names.projects')])]);
            return ;
        }
        $service->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>'service'])]);
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }
}
