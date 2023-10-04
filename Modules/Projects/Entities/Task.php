<?php

namespace Modules\Projects\Entities;

use App\Models\City;
use App\Models\Hr\Branch;
use App\Models\Message;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Projects\Database\factories\ProjectFactory;
use Modules\Projects\Database\factories\TaskFactory;

class Task extends ProjectsMainModel
{
    protected $fillable = ['name','start_date','actual_date' , 'project_id' ,'branch_id','status_id','city_id' , 'latitude', 'longitude'];

    protected $table = 'tasks';

//    protected $appends = ['progress','duration'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class)->where('type','tasks');
    }
    public function childrens()
    {
        return $this->hasMany(Task::class,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Task::class,'parent_id');
    }

    public function getStartAtAttribute()
    {
        return date('d/m/Y', strtotime($this->start_date));
    }

    public function getExpectedAtAttribute()
    {
        return Carbon::parse($this->start_date)->addDays($this->duration)->format('d/m/Y');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'task_user','user_id','task_id');
    }

    protected static function newFactory()
    {
        return TaskFactory::new();
    }

}
