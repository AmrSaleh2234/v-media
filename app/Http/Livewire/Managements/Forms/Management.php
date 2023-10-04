<?php

namespace App\Http\Livewire\Managements\Forms;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Employee\Employee;
use App\Models\Hr\Department;
use App\Models\Hr\Management as HrManagement;
use App\Services\BranchService;
use App\Models\User;

class Management extends BasicForm
{
    public $branch_id;
    public $branches = [];
    public $type ;
    public $management_parents = [];
    public $parent_id;
    public $types = [];
    public $name;
    public $manager_id;
    private $branchService;
    public $managers = [];
    public $departments = [];
    public $management;
    public $deps_managers = [];

    protected $rules = [
        'name' => 'required',
        'branch_id' => 'required|exists:branches,id',
        'type' => 'required',
        'parent_id' => 'required_if:type,sub',
        'departments.*.name' => 'required',
        'manager_id' => 'required',
    ];

    public function mount($branch_id = null, $management_id = null) {
        $this->types  = [
            "" => __('names.select') ,
            "main" => __('names.main') ,
            "sub" => __('names.sub')
        ];

        $this->branchService = new BranchService();

        if($branch_id != null) {
            $this->branch_id = $branch_id;
        }

        if($management_id != null) {
            $management = HrManagement::where('id',$management_id)->with('departments')->first();
            $this->management = $management;
            $this->name = $management->name;
            $this->type = $management->type;
            $this->branch_id = $management->branch_id;
            $this->parent_id = $management->parent_id;
            $this->manager_id = $management->manager_id;
            if(count($management->departments) >= 1 ) {
               foreach($management->departments as $department) {
                $this->departments[] = ['id' => $department->id ,'name' => $department->name, 'manager_id' => $department->manager_id];
               }
            }
        }

        $this->branches = $this->branchService->fetchAsArray($branch_id);
        $this->management_parents = HrManagement::where('type' , 'main')->pluck('name','id')->toArray();


        $usersHavePermission = User::whereHas('roles',function($query) {
            $query->whereHas('permissions', function($sub) {
                $sub->where('name' , 'managers.managements');
            });
        })->select('id')->pluck('id')->toArray();

        $this->managers = Employee::whereIn('user_id', $usersHavePermission)->get();

        $depsHavePermission = User::whereHas('roles',function($query) {
            $query->whereHas('permissions', function($sub) {
                $sub->where('name' , 'managers.departments');
            });
         })->select('id')->pluck('id')->toArray();

        $this->deps_managers = Employee::whereIn('user_id', $depsHavePermission)->get();
    }

    public function render()
    {
        return view('livewire.managements.forms.management');
    }

    public  function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save() {
        $validate = $this->validate();


        if($this->management != null) {
            $this->management->update($validate);
            // update departments

             foreach($this->departments as $department)
                {
                    if(array_key_exists('id' , $department)) {
                        $old = Department::where('id', $department['id'])->first();
                        $old->update($department);
                    } else {
                        $department['management_id'] = $this->management->id;
                        $department['type'] = "main";
                        Department::create($department);
                    }

                }
             $this->dispatchBrowserEvent('toastr',
                    ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.managements')])]);

        } else {
          $management = new HrManagement($validate);
          $management->save();


          foreach($this->departments as $department)
          {
            $department['management_id'] = $management->id;
            $department['type'] = "main";
            $department['manager_id'] = null;
            Department::create($department);
          }
             $this->dispatchBrowserEvent('toastr',
                    ['type' => 'success',  'message' =>__('message.created',['model'=>__('names.managements')])]);

        $this->reset('departments','parent_id','name','type');
        }
    }

    public function addDepartment() {
        $this->departments[] = ['name' => '' , 'manager_id' => '' , 'services' => ''];
    }


}
