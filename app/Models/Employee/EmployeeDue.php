<?php

namespace App\Models\Employee;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDue extends MainModel
{
    use HasFactory;

    protected $fillable = ["employee_id","name", "value"];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
