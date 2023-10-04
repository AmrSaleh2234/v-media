<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee\Employee;
use App\Http\Livewire\Basic\BasicForm;
use App\Models\Employee\EmployeeDue;
use App\Services\EmployeeService;
use Exception;
use Illuminate\Support\Facades\Validator;
class StepFour extends BasicForm
{

    protected $rules = [
        'finance.salary' => 'required',
        'finance.work_days_in_week' => 'required',
        'finance.work_hours' => 'required',
        'finance.hour_type' => 'nullable',
        'finance.allowances' => 'required',
        'finance.car_allownce' => 'required',
        'finance.hourly_value' => 'required',
        'finance.total' => 'required',
        'finance.minute_value' => 'nullable',

        'vacation.name' => 'required',
        'vacation.type' => 'required',
        'vacation.date_of_hiring' => 'required',
        'vacation.due_date' => 'required',
        'vacation.mechanism_before_duration' => 'required',
        'vacation.vacation_credit' => 'required',
        'vacation.work_duration' => 'required',
        'vacation.vacation_deduction' => 'required',
        'vacation.without_warning' => 'required',
    ];

    public $employee_id;
    public $finance;
    public $dues;
    public $vacation;

    public $emp_vacations;
    public function mount($employee_id = null) {
        $emp = Employee::findOrFail($employee_id);
        $this->employee_id = $emp->id;
        $this->finance = $emp->finance;
        $this->emp_vacations = $emp->vacation;
       $this->updateDues();

    }


    public function close($modal_id)
    {
        $this->dispatchBrowserEvent('closeModal',['id'=>$modal_id]);
    }

    public function render()
    {
        return view('livewire.employee.step-four');
    }

    public function updateDues() {
        $this->reset("dues");
         $empService = new EmployeeService();
        $dues = $empService->getDues($this->employee_id);
         foreach($dues as $due) {
            $this->dues[$due->name] = (array) json_decode($due->value);
        }


    }

    public function updatedfinanceAllowances() {
       $this->calculateTotal();
       $this->calcHourValue();
    }

    public function updatedfinanceCarAllownce() {
        $this->calculateTotal();
        $this->calcHourValue();
    }

    public function updatedfinanceSalary() {
       $this->calculateTotal();
        $this->calcHourValue();
    }

    public function updatedfinanceWorkDaysInWeek() {
        $this->calcHourValue();
    }

    public function updatedfinanceWorkHours() {
        $this->calcHourValue();
    }

    private function calcHourValue() {
         try {
            if($this->finance['work_hours'] != 0 && $this->finance['work_days_in_week'] != 0) {

                $this->finance['hourly_value'] = round( $this->finance['total'] / $this->finance['work_days_in_week'] /

                $this->finance['work_hours'],2);

                $this->finance['minute_value'] = round($this->finance['hourly_value'] / 60,2);

            } else {
                $this->finance['horly_value'] = 0;
            }

         } catch(Exception $e) {
            $this->finance['horly_value'] = 0;
         }
    }

    private function calculateTotal() {

        $this->finance['total'] = round(( $this->finance['salary'] + $this->finance['car_allownce'] +
        $this->finance['allowances'] ) ,2);
    }


    public function addDues() {
       // dd($this->dues);

       if(empty($this->dues)) {
         $this->dispatchBrowserEvent('toastr',
         ['type' => 'error', 'message' => __('names.all-fields-required')]);
        return;
       }
        $service = new EmployeeService();
        foreach($this->dues as $key=>$due) {
            $service->storeDues($this->employee_id , $key, $due);
        }
        $this->updateDues();
        $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>  __('message.saved-success')]);

        $this->close("addDues");

    }


    public function addVacation() {


          if(empty($this->vacation)) {
          $this->dispatchBrowserEvent('toastr',
          ['type' => 'error', 'message' => __('names.all-fields-required')]);
          return;
          }

        $validated = Validator::make($this->vacation,[
            'name' => 'required',
            'date_of_hiring' => 'required',
            'due_date' => 'required',
            'vacation_credit' => 'required',
            'work_duration' => 'required',
            'vacation_deduction' => 'required',
            'without_warning' => 'required',
        ])->validate();


        $this->vacation['employee_id'] = $this->employee_id;

        $empService = new EmployeeService();
        $empService->storeVacation($this->vacation);
         $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>  __('message.saved-success')]);

        $this->close("addVacation");

        $this->emp_vacations = $this->vacation;
    }

    public function save() {
        $empService = new EmployeeService();


        $empService->storeFinance($this->finance, $this->employee_id);

           $this->dispatchBrowserEvent('toastr',
                ['type' => 'success',  'message' =>  __('message.saved-success')]);


        return redirect()->route('admin.custom.create',['employee_id' => $this->employee_id, 'step' => 5]);
    }
}
