<?php

namespace App\Models\Hr;

use App\Models\Employee\Employee;
use App\Models\MainModelSoft;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobGrade extends MainModelSoft
{
    use HasFactory , LogsActivity;

    protected $table = 'job_grades';

    protected $fillable = [ 'name', 'active', 'description','salary','years', 'job_type_id','grade_id'];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function jobType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(JobType::class);
    }

    public function grade(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class,'employment_data','employee_id','job_grade_id')->where('draft',0);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "This JobType has been {$eventName}")
            ->logOnly([ 'name', 'active', 'description','salary','years', 'job_type_id','grade_id'])
            ->logOnlyDirty()
            ->useLogName('system');;
        // Chain fluent methods for configuration options
    }

}
