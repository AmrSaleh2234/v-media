<?php

namespace App\Http\Livewire\Employee;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Currency;
use App\Models\Employee\Employee;
use App\Models\Hr\Branch;
use App\Models\Hr\Department;
use App\Models\Hr\Grade;
use App\Models\Hr\JobName;
use App\Models\Hr\JobType;
use App\Models\Hr\Management;
use App\Services\EmployeeService;


class StepThree extends BasicForm
{

    protected $rules = [

        'employmentData.job_name_id' => 'required|exists:job_names,id',
        'employmentData.job_grade_id' => 'required',
        'employmentData.job_type_id' => 'required|exists:job_types,id',
        'branch_id' => 'required|exists:branches,id',
        'management_id' => 'nullable',
        'department_id' => 'nullable',
        'contract.start_date' => 'required',
        'contract.end_date' => 'required|after:contract.start_date',
        'contract.join_date' => 'required|after:contract.start_date|before:contract.end_date',
        'contract.test_end_date' => 'required|after:contract.start_date|after:contract.join_date|before:contract.end_date',
        'employeeFinance.currency_id' => 'required|exists:currencies,id',
        'employeeFinance.salary_circle' => 'required',

    ];

    public $employee_id ;
    public $contract;
    public $employmentData;
    public $branch_id = null;
    public  $management_id =  null;
    public $department_id = null;
    public $employeeFinance;

    public $jobNames = [];
    public $jobGrades = [];
    public $jobTypes = [];

    public $branches = [];
    public $managments = [];
    public $departments = [];

    public $currencies = [];
    public $salaryCycles = [];

    public function mount($employee_id = null) {

        $emp = Employee::whereId($employee_id)->first();
        $empService = new EmployeeService();
        $this->branches = Branch::pluck('name','id')->toArray();
       if(isset($emp->workAt)){
        if($emp->workAt->workable instanceof Branch) {
            $this->branch_id = $emp->workAt->workable->id;
        }



       if($emp->workAt->workable instanceof Management) {
         $this->branch_id = $emp->workAt->workable->branch_id;
         $this->management_id = $emp->workAt->workable->id;
         $this->managments = Management::where('branch_id',$this->branch_id)->pluck('name','id')->toArray();
         $this->departments = Department::where('management_id',$this->management_id )->pluck('name','id')->toArray();
       }
       if($emp->workAt->workable instanceof Department) {
            $this->branch_id = $emp->workAt->workable->management->branch_id;
            $this->management_id = $emp->workAt->workable->management->id;
            $this->department_id = $emp->workAt->workable->id;
            $this->managments = Management::where('branch_id',$this->branch_id)->pluck('name','id')->toArray();
            $this->departments = Department::where('management_id',$this->management_id )->pluck('name','id')->toArray();
       }
       }

        $this->employee_id = $employee_id;

        $this->contract = $empService->getContract($this->employee_id);
        $this->employmentData = $empService->getEmploymentData($this->employee_id);
        $this->employeeFinance = $empService->getFinance($this->employee_id);



        if($this->employmentData) {
            $this->jobNames = JobName::where('job_type_id',$this->employmentData['job_type_id'])->pluck('name','id')->toArray();
        }

        $this->jobGrades = Grade::pluck('name','id')->toArray();
        $this->jobTypes = JobType::pluck('name','id')->toArray();


        $this->currencies = Currency::pluck('name','id')->toArray();
        $this->salaryCycles = moneyType();
    }

    public function render()
    {
        return view('livewire.employee.step-three');
    }

    public function save() {
        $validated = $this->validate();
        $empService = new EmployeeService();



        // save employmentData
        $empService->storeEmploymentData($validated['employmentData'] , $this->employee_id);

        //save finance
        $empService->storeFinance($validated['employeeFinance'], $this->employee_id);


        //saveContract
        $empService->storeContract($validated['contract'], $this->employee_id);


        $empService->storeWorkAt($this->employee_id, $this->branch_id, $this->management_id, $this->department_id);

          $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>  __('message.saved-success')]);


        return redirect()->route('admin.custom.create',['employee_id' => $this->employee_id, 'step' => 4]);

    }


    public function updatedemploymentDataJobTypeId($data) {
        $this->jobNames = JobName::where('job_type_id',$data)->pluck('name','id')->toArray();
    }

    public function updatedBranchId($data) {
        $this->managments = Management::where('branch_id',$data)->pluck('name','id')->toArray();
    }

    public function updatedmanagementId($data){
        $this->departments = Department::where('management_id',$data)->pluck('name','id')->toArray();
    }
}
