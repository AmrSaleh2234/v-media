<?php

namespace App\Models\Employee;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeVacation extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ["employee_id","name","type","date_of_hiring","due_date","mechanism_before_duration","vacation_credit","work_duration","vacation_deduction","without_warning"];


    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
