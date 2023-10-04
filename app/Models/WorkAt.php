<?php

namespace App\Models;

use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Znck\Eloquent\Traits\BelongsToThrough;

class WorkAt extends MainModel
{
     use HasFactory,BelongsToThrough;


    // protected $table = "work_ats";
     protected $fillable = [
        'employee_id',
        'workable_type',
        'workable_id'
    ];

    public function workable()
    {
        return $this->morphTo();
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

}
