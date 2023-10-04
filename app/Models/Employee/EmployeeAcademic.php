<?php

namespace App\Models\Employee;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeAcademic extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['employee_id', 'university_id', 'qualification', 'specialization', 'qualification_date', 'qualification_photo'];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
