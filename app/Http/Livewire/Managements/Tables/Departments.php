<?php

namespace App\Http\Livewire\Managements\Tables;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Hr\Department;
use Livewire\Component;

class Departments extends BasicTable
{
    protected $listeners = ['confirmDelete'];

    public $management_id;


    public function mount($management_id) {
        $this->management_id = $management_id;
         Department::where('management_id',$management_id)->with(['management' => function($query) {
            $query->withCount('departments');
        }])->get();
    }

    public function render()
    {
        return view('livewire.managements.tables.departments',[
            'departments' => Department::where('management_id',$this->management_id)->with(['management' => function($query) {
            $query->withCount('departments');
            }])->get()
        ]);
    }

     public function confirmDelete($id) {

        $department = Department::findOrFail($id);
       if(count($department->workers) >= 1) {
            $this->dispatchBrowserEvent('toastr',
                ['type' => 'warning', 'message'
                =>__('message.still-has',['model'=>__('names.department'),'relation'=>__('names.employees')])]);
                return ;
        } else{
            $department->delete();
            $this->dispatchBrowserEvent('toastr',
            ['type' => 'success', 'message' =>__('message.deleted',['model'=>__('names.department')])]);
        }

        $this->emitSelf('$refresh');

    }
}
