<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends MainModelSoft
{
    protected $table = 'pages';
    protected $fillable = ['user_id','link','name','title','content','type','active','order_id','parent_id'];
    protected $casts = [
        'name' => 'array',
        'title' => 'array',
        'content' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function childrens() {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function parent() {
        return $this->belongsTo(Page::class, 'parent_id')->withTrashed();
    }
    public function sections(){
        return $this->hasMany(Section::class);
    }
}
