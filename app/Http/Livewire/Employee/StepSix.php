<?php

namespace App\Http\Livewire\Employee;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Employee\Employee;
use Livewire\Component;

class StepSix extends BasicForm
{

    public $employee;

    public function mount($employee_id) {
        $this->employee = Employee::findOrFail($employee_id);
    }

    public function render()
    {
        return view('livewire.employee.step-six');
    }
}
