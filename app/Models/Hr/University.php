<?php

namespace App\Models\Hr;

use App\Models\Employee\EmployeeAcademic;
use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['name','name_ar'];

    public function employeeAcademics(){
        return $this->hasMany(EmployeeAcademic::class);
    }

}
