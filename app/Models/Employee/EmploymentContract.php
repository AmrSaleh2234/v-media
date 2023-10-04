<?php

namespace App\Models\Employee;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmploymentContract extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['employee_id','start_date','end_date','join_date','test_end_date'];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
