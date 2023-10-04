<?php

namespace App\Http\Livewire\Employee;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Employee\Employee;
use App\Models\Hr\Branch;
use App\Models\Hr\Department;
use App\Models\Hr\Management;
use App\Models\Hr\Shift;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StepFive extends BasicForm
{

    protected $rules = [
        'shift_id' => 'nullable',
        'auth.username' => 'required',
        'auth.password' => 'required',
        'auth.role_id' => 'required',
    ];

    public $employee_id;
    public $mainBranches = [];
    public $shifts = [];
    public $shift_id;
    public $ableToChange = false;

    public $employeeBranchId;
    public $inputType = "text";
    public $auth = [];

    public $roles = [];

    public function mount($employee_id) {
        $this->employee_id = $employee_id;
        $employee = Employee::with('workAt')->whereId($employee_id)->first();
        $user = User::where('id',$employee->user_id)->first();
        $auth['user_name'] = $user->name;
        if($employee->workAt?->workable instanceof Branch) {
            $this->employeeBranchId = $employee->workAt->workable->id;
        }

          if($employee->workAt?->workable instanceof Management) {
            $this->employeeBranchId = $employee->workAt->workable->branch_id;
         }
        if($employee->workAt?->workable instanceof Department) {
                $this->employeeBranchId = $employee->workAt->workable->management->branch_id;
        }
        $this->shift_id = Branch::whereId($this->employeeBranchId)->first()->shift_id;

        if($employee->shift_id != null) {
            $this->shift_id = $employee->shift_id;
            $this->ableToChange = true;
        }

        $this->mainBranches = Branch::where('parent_id',null)->pluck('name','id')->toArray();
        $this->shifts = Shift::pluck('name','id')->toArray();
        $this->roles = Role::pluck('name','id')->toArray();
        if(count($user->roles) >= 1) {
            $this->auth['role_id'] = $user->roles[0]->id;
        }
    }

    public function render()
    {
        return view('livewire.employee.step-five');
    }

    public function updatedableToChange($data) {

        if($data == false) {
            $this->shift_id = Branch::whereId($this->employeeBranchId)->first()->shift_id;
        }
    }

    public function save() {

        $employee = Employee::whereId($this->employee_id)->first();
        if($employee) {
            $employee->shift_id = $this->shift_id;
            $employee->draft = 0;
            $employee->save();
            $user = User::where('id', $employee->user_id)->first();

            if( !array_key_exists("role_id", $this->auth) || empty($this->auth['role_id'])) {
                $this->dispatchBrowserEvent('toastr',
                ['type' => 'error', 'message' => __('validation.required' , ['attribute' => __('names.role')])]);
                return;
            }

            $role = Role::where('id', $this->auth['role_id'])->first();
            $user->syncRoles([]);
            $user->assignRole($role);

            if(array_key_exists("password", $this->auth) && ! empty($this->auth['password'])) {

                $user->password = Hash::make($this->auth['password']);
                $user->save();
            }

            if(array_key_exists("username", $this->auth)  && ! empty($this->auth['username'])) {

                $user->name = $this->auth["username"];
                $user->save();
            }
        }


       $this->dispatchBrowserEvent('toastr',
       ['type' => 'success', 'message' => __('message.saved-success')]);


        return redirect()->route('admin.custom.create',['employee_id' => $this->employee_id, 'step' => 6]);
    }

    public function changeTextType() {
        if($this->inputType == "text") {
            $this->inputType="password" ;
        } else {
            $this->inputType="text" ;
        }
    }
}
