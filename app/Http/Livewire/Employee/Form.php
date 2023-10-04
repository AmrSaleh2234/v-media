<?php

namespace App\Http\Livewire\Employee;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Employee\Employee;

class Form extends BasicForm
{

    protected $listeners = [
        'changeStep'=> 'UpdateStep',
    ];
    public $employee;
    public $step = 1;
    public function mount($employee_id = null , $step = 1) {

        if($employee_id != null) {
            $this->employee = Employee::where('id',$employee_id)->first();
        }

        if($this->employee == null) {
            $this->step = 1;
        } else {
            $this->step = $step;
        }

    }
    public function render()
    {
        return view('livewire.employee.form');
    }

    public function UpdateStep($data) {
        $this->step = $data;
    }
}
