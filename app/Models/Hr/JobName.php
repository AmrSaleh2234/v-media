<?php

namespace App\Models\Hr;

use App\Models\Employee\Employee;
use App\Models\Employee\EmploymentData;
use App\Models\MainModelSoft;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobName extends MainModelSoft
{
    use HasFactory ,LogsActivity;

    protected $table = 'job_names';

    protected $fillable = [ 'name', 'active', 'description', 'job_type_id'];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function jobType() {
        return $this->belongsTo(JobType::class);
    }

    public function employees() {
        return $this->belongsTo(EmploymentData::class,'id','job_name_id')->where(function($query) {
                $query->whereHas('employee',function($query) {
                $query->where('draft',0);
            });
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "This JobType has been {$eventName}")
            ->logOnly([ 'name', 'active', 'description', 'job_type_id'])
            ->logOnlyDirty()
            ->useLogName('system');;
        // Chain fluent methods for configuration options
    }

}
