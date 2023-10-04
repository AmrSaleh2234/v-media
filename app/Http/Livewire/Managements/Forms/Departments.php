<?php

namespace App\Http\Livewire\Managements\Forms;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Employee\Employee;
use App\Models\Hr\Department;
use App\Models\User;
use Livewire\Component;

class Departments extends BasicForm
{
    public $name;
    public $manager_id;
    public $services;
    public $types = [];
    public $parent_id;
    public $type;
    public $managers = [];
    public $management_id;
    public $parents = [];

    public $department;

    protected $rules = [
        'name' => 'required',
        'type' => 'required',
        'parent_id' => 'required_if:type,sub',
        'manager_id' => 'required'

    ];

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($management_id , $department_id = null) {
        $this->management_id = $management_id;
        $this->types  = [
            "" => __('names.select') ,
            "main" => __('names.main') ,
            "sub" => __('names.sub')
        ];

        $this->parents = Department::where(['management_id' => $management_id , 'type' => 'main'])->pluck('name','id')->toArray();

        if($department_id != null) {
            $this->department = Department::findOrFail($department_id);
            $this->name = $this->department->name;
            $this->parent_id = $this->department->parent_id;
            $this->type = $this->department->type;
            $this->manager_id = $this->department->manager_id;
        }

         $depsHavePermission = User::whereHas('roles',function($query) {
            $query->whereHas('permissions', function($sub) {
                $sub->where('name' , 'managers.departments');
            });
         })->select('id')->pluck('id')->toArray();

         $this->managers = Employee::whereIn('user_id', $depsHavePermission)->get();
    }

    public function save() {
        $validated = $this->validate();
        $validated['management_id'] = $this->management_id;
        if($this->department != null) {
            $this->department->update($validated);
              $this->dispatchBrowserEvent('toastr',
                    ['type' => 'success',  'message' =>__('message.create',['model'=>__('names.departments')])]);

        } else {
            Department::create($validated);
            $this->dispatchBrowserEvent('toastr',
                    ['type' => 'success',  'message' =>__('message.create',['model'=>__('names.departments')])]);
            $this->reset('type','name','manager_id','services');
        }
    }

    public function render()
    {
        return view('livewire.managements.forms.departments');
    }



}
