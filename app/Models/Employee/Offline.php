<?php

namespace App\Models\Employee;

use App\Models\Attendance;
use App\Models\Hr\Shift;
use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offline extends MainModelSoft
{
    protected $fillable = ['time','attendance_id'];

    public function Attendance()
    {
        return $this->belongsTo(Attendance::class);
    }


}
