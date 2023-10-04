<?php

namespace App\Models\Employee;

use App\Models\MainModelSoft;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRequest extends MainModelSoft
{
    protected $fillable = ['type', 'reason' , 'project_name','name', 'responsible', 'time_from','time_to', 'latitude', 'longitude','address','from', 'response', 'employee_id', 'status_id'];
    protected $casts = ['time_from'=>'datetime','time_to'=>'datetime'];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function getFromTimeAttribute()
    {
        return $this->time_from?->format('H:i') ;
    }

    public function getToTimeAttribute()
    {
        return $this->time_to?->format('H:i') ;
    }


}
