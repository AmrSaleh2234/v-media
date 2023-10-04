<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends MainModelSoft
{
    protected $table = 'comments';

    protected $fillable = [
        'user_id','link','name', 'title','content', 'parent_id', 'post_id','app','website'
    ];

    protected $casts = [
        'name' => 'array',
        'title' => 'array',
        'content' => 'array'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }


    public function addressable()
    {
        return $this->morphTo();
    }
}
