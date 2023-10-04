<?php

namespace App\Http\Livewire\Employee;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAcademic;
use App\Models\Employee\EmployeeCourse;
use App\Models\Employee\EmployeeDue;
use App\Models\Employee\EmployeeExperience;
use App\Models\Employee\EmployeeFinance;
use App\Models\Employee\EmployeeInfo;
use App\Models\Employee\EmployeeVacation;
use App\Models\Employee\EmploymentContract;
use App\Models\Employee\EmploymentData;
use App\Models\Hr\Branch;
use App\Services\EmployeeService;

use App\Models\User;


class Table extends BasicTable
{

    protected $listeners = ['confirmDelete'];

    public $branches;
    public $branchId = 0;
    public $draft = 0;

    public $q;

    public function mount($branchId = null) {
        if($branchId != null) {
            $this->branchId = $branchId;
        }
        $this->branches = Branch::pluck('name', 'id')->toArray();

    }
    public function render()
    {


        $employeeService = new EmployeeService();

        $employees = $employeeService->search($this->search, $this->draft)
                                        ->when($this->branchId,function ($query){
                                             $query->branch($this->branchId);
                                        })
                                        ->when($this->start_date,function ($query){
                                             $query->where('created_at',$this->start_date);
                                        })->when($this->end_date,function ($query){
                                             $query->where('created_at',$this->end_date);
                                        })
                                        ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')->paginate($this->perPage);
                                        $draft_count = Employee::where('draft', 1)->count();
        return view('livewire.employee.table',[
            'employees' => $employees,
            'draft_count' => $draft_count,
        ]);
    }

    public function confirmDelete($id){

        $employee = Employee::findOrFail($id);
        if(!empty($employee->attendances) && count($employee->attendances) >= 1) {
            $this->dispatchBrowserEvent('toastr',
            ['type' => 'error', 'message' => __('message.still-has',['Model' => __('names.employee') , 'Relation' =>
            __('names.attendance-log')])]);
            return ;
        }


        if(!empty($employee->requests) && count($employee->requests) >= 1) {
             $this->dispatchBrowserEvent('toastr',
             ['type' => 'error', 'message' => __('message.still-has',['Model' => __('names.employee') , 'Relation' =>
             __('names.employee-request')])]);
             return ;
        }

        $user = User::whereId($employee->user_id)->first();
        if ($user){
            $user->delete();
        }

        $academic = EmployeeAcademic::where('employee_id', $employee->id)->get();
        if(!empty($academic)) {
            foreach($academic as $ac) {
                $ac->delete();
            }
        }

        $courses = EmployeeCourse::where('employee_id', $employee->id)->get();
        if(!empty($courses)) {
            foreach($courses as $ac) {
                 $ac->delete();
            }
        }


        $dues = EmployeeDue::where('employee_id', $employee->id)->get();
        if(!empty($dues)) {
            foreach($dues as $due) {
                $due->delete();
            }
        }


        $experinces = EmployeeExperience::where('employee_id', $employee->id)->get();
        if(!empty($experinces)) {
            foreach($experinces as $ex) {
                $ex->delete();
            }
        }

        $finances = EmployeeFinance::where('employee_id', $employee->id)->get();
        if(!empty($finances)) {
            foreach($finances as $fc) {
                $fc->delete();
            }
        }

        $info = EmployeeInfo::where('employee_id', $employee->id)->get();
        if(!empty($info)) {
            foreach($info as $if) {
                $if->delete();
            }
        }


        $vacations = EmployeeVacation::where('employee_id', $employee->id)->get();
        if(!empty($vacations)) {
            foreach($vacations as $va) {
                $va->delete();
            }
        }

        $contracts = EmploymentContract::where('employee_id', $employee->id)->get();
        if(!empty($contracts)) {
            foreach($contracts as $cs) {
                $cs->delete();
            }
        }

        $empData = EmploymentData::where('employee_id', $employee->id)->get();
        if(!empty($empData)) {
            foreach($empData as $ed) {
                $ed->delete();
            }
        }


        $employee->delete();
        $this->dispatchBrowserEvent('toastr',
        ['type' => 'success', 'message' => __('message.deleted',['model' => __('names.employee')])]);
    }

    public function changeDraft(){
        $this->draft = $this->draft == 0 ? 1 : 0;
    }

}
