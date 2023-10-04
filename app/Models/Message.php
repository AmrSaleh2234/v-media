<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Nwidart\Modules\Facades\Module;

class Message extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['from_id','to_id', 'content' ,'public', 'messageable_id' , 'messageable_type'];


    protected $casts = ['public' => 'boolean','created_at'=>'datetime:g:i a'];// 'seen_at' => 'datetime:Y-m-d H:00'

    public function messageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function seen()
    {
        return $this->belongsToMany(User::class,'message_user_seen')->withPivot('seen_at');
    }
//    public function seen()
//    {
//        return $this->belongsToMany(Seen::class)->withPivot('seen_at');
//    }
    public function from()
    {
        return $this->belongsTo(User::class,'from_id');
    }

    public function lastBy()
    {
        return $this->belongsTo(User::class,'from_id')->latestOfMany();
    }

    public function to()
    {
        return $this->belongsTo(User::class,'to_id');
    }

    public function lastFrom() {
        return $this->morphedByMany(User::class,'messageable')->latestOfMany();
    }

    public function scopeProject($query,$id)
    {
        return (Module::isEnabled('Projects')) ? $query->where('messageable_type','Modules\Projects\Entities\Project')->where('messageable_id',$id) : null;
    }

//    public function getSeenAttribute()
//    {
//        return date('Y-m-d H:00', strtotime($this->seen_at));
//    }


}
