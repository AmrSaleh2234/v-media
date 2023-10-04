<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends MainModelSoft
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id','link','title','content','app','website'
    ];
    protected $casts = [
        'title' => 'array',
        'content' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function categories() {
        return $this->belongsToMany(Category::class)->where('type','post')->withTrashed();
    }

    public function childrens() {
        return $this->hasMany(Post::class, 'parent_id');
    }

    public function parent() {
        return $this->belongsTo(Post::class, 'parent_id')->withTrashed();
    }
}
