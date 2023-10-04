<?php

namespace App\Models\Employee;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCourse extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['name','course_from','duration','date','certificate_photo','employee_id'];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
