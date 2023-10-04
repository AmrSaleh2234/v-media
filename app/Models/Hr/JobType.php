<?php

namespace App\Models\Hr;

use App\Models\Employee\Employee;
use App\Models\Employee\EmploymentData;
use App\Models\MainModelSoft;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobType extends MainModelSoft
{
    use HasFactory ,LogsActivity ;

    protected $table = 'job_types';

    protected $fillable = ['name', 'active', 'description'];

    protected $casts = [
        // 'name' => 'array',
        //'note' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function jobNames() {
        return $this->hasMany(JobName::class,'job_type_id','id');
    }
    public function jobGrades() {
        return $this->hasMany(JobGrade::class);
    }

    public function employees() {
        return $this->belongsTo(EmploymentData::class,'id','job_type_id')->where(function($query) {
            $query->whereHas('employee',function($query) {
                $query->where('draft',0);
            });
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "This JobType has been {$eventName}")
            ->logOnly(['name', 'active', 'description'])
            ->logOnlyDirty()
            ->useLogName('system');;
        // Chain fluent methods for configuration options
    }
}
