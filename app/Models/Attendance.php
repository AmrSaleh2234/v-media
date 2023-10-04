<?php

namespace App\Models;

use App\Models\Employee\Employee;
use App\Models\Hr\Shift;
use App\Models\Employee\Offline;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ["employee_id", "shift_id", "check_in", "check_out" ,"time_zone"];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function shift() {
        return $this->belongsTo(Shift::class);
    }

    public function offline()
    {
        return $this->hasOne(Offline::class);
    }

}
