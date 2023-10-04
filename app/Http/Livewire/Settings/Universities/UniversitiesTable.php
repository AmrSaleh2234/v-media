<?php

namespace App\Http\Livewire\Settings\Universities;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Hr\University;
use App\Services\UniversityService;
use Livewire\Component;

class UniversitiesTable extends BasicTable
{
    protected $listeners = ['confirmDelete'];

    public $perPage = 50 ;
    public function render()
    {
        $service = new UniversityService();
        return view('livewire.settings.universities.universities-table',[
            'universities' => $service->search($this->search)
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

    public function toggle($id){
        $university = University::find($id);
        $university->active = !$university->active ;
        $university->save();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.university')])]);
        return ;
    }


    public function confirmDelete($id)
    {
        $university = University::find($id);
        if ($university->active) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-active',['model'=>__('names.university'),'relation'=>__('names.dashboard')])]);
            return ;
        }elseif($university->employeeAcademics()->exists()){
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning',  'message' =>__('message.still-has',['model'=>__('names.university'),'relation'=>__('names.employee')])]);
            return ;
        }
        $university->delete();
        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.deleted',['model'=>__('names.university')])]);
        // Refresh the component to reflect the updated data
        $this->emitSelf('$refresh');
    }



}
