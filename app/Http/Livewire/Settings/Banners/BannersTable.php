<?php

namespace App\Http\Livewire\Settings\Banners;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\CMS\Banner;
use App\Services\CMS\BannerService;
use Livewire\Component;

class BannersTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];

    public function render()
    {
        $service = new BannerService();
        return view('livewire.settings.banners.banners-table',[
            'banners' => $service->search($this->search)
//                ->confirmed()
//                ->with('category')
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
        $banner = Banner::find($id);

        if ($banner->app) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.banner'),'relation'=>__('names.application')])]);
            return ;
        } elseif($banner->website) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.banner'),'relation'=>__('names.website')])]);
            return ;
        }
        $banner->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'warning',  'message' =>__('message.deleted',['model'=>'banner'])]);

        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }
}
