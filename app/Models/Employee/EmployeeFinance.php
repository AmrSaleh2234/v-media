<?php

namespace App\Models\Employee;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Currency;

class EmployeeFinance extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ["employee_id","currency_id","salary_circle","salary","work_days_in_week","work_hours","allowances","car_allownce","total","hourly_value","minute_value"];


    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function currency() {
        return $this->hasOne(Currency::class, 'id' , 'currency_id');
    }
}
