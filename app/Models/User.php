<?php

namespace App\Models;

use App\Models\Employee\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;
use Laravolt\Avatar\Facade as Avatar ;

use Spatie\Permission\Traits\HasRoles;
class User extends AuthModel
{

    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['avatar'];

    public function isActive()
    {
        return Auth::user()->active == 1;
    }

    public function scopeProjectUsers($query , $projectId) {
        return (Module::isEnabled('Projects')) ? $query->whereHas('projects',function ($q) use ($projectId) {
            $q->where('projects.id',$projectId);
        })->orWhereHas('tasks',function ($q) use ($projectId) {
            $q->where('tasks.project_id',$projectId);
        }) : null ;
    }

    public function employee() {
        return $this->hasOne(Employee::class,'user_id', 'id');
    }

    public function messages() {
        return $this->hasMany(Message::class,'from_id')->latest();
    }

    public function sent() {
        return $this->hasMany(Message::class,'from_id')->latest();
    }

    public function received() {
        return $this->hasMany(Message::class,'to_id')->latest();
    }

    public function lastSent() {
        return $this->hasOne(Message::class,'from_id')->latest();
    }

    public function lastReceived() {
        return $this->hasOne(Message::class,'to_id')->latest();
    }

    public function lastMsg()
    {
        return $this->hasOne(Message::class, 'from_id', 'id')
            ->orWhere(function ($query) {
                $query->where('to_id', $this->id);
            })
            ->latest();
    }

    public function seens()
    {
        return $this->belongsToMany(Message::class,'message_user_seen')->withPivot('seen_at');
    }

    public function projects()
    {
        return (Module::isEnabled('Projects')) ? $this->hasMany(\Modules\Projects\Entities\Project::class) : null;
    }
    public function tasks()
    {
        return (Module::isEnabled('Projects')) ? $this->belongsToMany(\Modules\Projects\Entities\Task::class,'task_user') : null;
    }

    public function getAvatarAttribute()
    {
        return Avatar::create(Str::title($this->name))->toBase64();
    }

    public function getCreatedAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }


}
