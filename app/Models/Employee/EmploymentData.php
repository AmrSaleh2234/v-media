<?php

namespace App\Models\Employee;

use App\Models\Hr\JobGrade;
use App\Models\Hr\JobName;
use App\Models\Hr\JobType;
use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmploymentData extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['employee_id','job_name_id','job_type_id','job_grade_id'];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function jobName() {
        return $this->belongsTo(JobName::class);
    }

    public function jobType() {
        return $this->belongsTo(JobType::class);
    }

    public function jobGrade() {
        return $this->belongsTo(JobGrade::class);
    }
}
