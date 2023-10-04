<?php

namespace App\Http\Livewire\Settings\Icons;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\CMS\Icon;
use App\Services\CMS\IconService;
use App\Services\CMS\PartnerService;
use Livewire\Component;

class IconsTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];
    public function render()
    {
        $service = new IconService();
        return view('livewire.settings.icons.icons-table',[
            'icons' => $service->search($this->search)
//                ->confirmed()
                ->when($this->start_date,function ($query){
                    $query->where('created_at','>=',$this->start_date);
                })
                ->when($this->end_date,function ($query){
                    $query->where('created_at','<=',$this->end_date);
                })
                ->when( $this->type !== 'all' ,function ($query){
                    $query->where('type',$this->type);
                })
//                ->select(['id','title'])
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage)
        ]);
    }

    public function confirmDelete($id)
    {
        $icon = Icon::find($id);

        if ($icon->app) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.icon'),'relation'=>__('names.application')])]);
            return ;
        } elseif($icon->website) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.icon'),'relation'=>__('names.website')])]);
            return ;
        }
        $icon->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>'icon'])]);

        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }

}
