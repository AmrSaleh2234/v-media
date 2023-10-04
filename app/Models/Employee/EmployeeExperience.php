<?php

namespace App\Models\Employee;

use App\Models\Hr\JobName;
use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EmployeeExperience extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['employee_id','company_name','job_name_id','from_date','to_date','no_of_years','photo'];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function jobName() {
        return $this->belongsTo(JobName::class);
    }

}
