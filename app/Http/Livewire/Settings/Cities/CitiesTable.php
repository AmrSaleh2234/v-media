<?php

namespace App\Http\Livewire\Settings\Cities;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\City;
use App\Services\CityService;
use Livewire\Component;

class CitiesTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];

    public $perPage = 100 ;

    public function render()
    {
        $service = new CityService();
        return view('livewire.settings.cities.cities-table',[
            'cities' => $service->search($this->search)
//                ->confirmed()
                ->with('state','country')
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
        $city = City::find($id);
      if($city->employees()->exists()) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.city'),'relation'=>__('names.employees')])]);
            return ;
        }
        $city->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.city')])]);
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }
}
