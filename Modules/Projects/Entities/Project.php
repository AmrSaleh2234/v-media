<?php

namespace Modules\Projects\Entities;

use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as Avatar;
use Modules\Projects\Database\factories\ProjectFactory;


class Project extends ProjectsMainModel
{
    use HasFactory , SoftDeletes ;
    protected $fillable = ['name','code','description','start_date', 'done_at','type','latitude','longitude'  , 'contract_id',  'client_id','user_id'];

    public static  $types = ['عقد رخص','رخصة بناء','عرض سعر'];

    protected $appends = ['avatar'];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function responsible()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function reqTasks()
    {
        return $this->hasMany(Task::class)->whereNull('done_at');
    }

    public function doneTasks()
    {
        return $this->hasMany(Task::class)->where('done_at');
    }


//    public function getProgressAttribute()
//    {
//        return round($this->done_tasks_count / ($this->done_tasks_count + $this->req_tasks_count) * 100) ?? 0;
//    }
    public function getDurationAttribute()
    {
        $duration = 0 ;
        foreach ($this->tasks as $task){
            $duration += $task->duration ;
        }
        return $duration ;
    }


    public function scopeNotDone()
    {
        return $this->whereNull('done_at');
    }
    public function scopeDone()
    {
        return $this->whereNotNull('done_at');
    }

    public function scopeNotAssigned()
    {
        return $this->whereNull('user_id');
    }
    public function scopeAssigned()
    {
        return $this->whereNotNull('user_id');
    }

    public function getCreatedAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function getStartAtAttribute()
    {
        return date('d/m/Y', strtotime($this->start_date));
    }

    public function getExpectedAtAttribute()
    {
        return Carbon::parse($this->start_date)->addDays($this->duration)->format('d/m/Y');
    }

//    public function getCreatedAttribute()
//    {
//        return date('d/m/Y', strtotime($this->created_at));
//    }

    protected static function newFactory()
    {
        return ProjectFactory::new();
    }

    public function getAvatarAttribute()
    {
        return Avatar::create(Str::title($this->name))->toBase64();
    }

}
