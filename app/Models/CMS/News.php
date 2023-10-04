<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends MainModelSoft
{
    protected $fillable = ['title','content','category_id','image','thumbnail','published_at','end_at','app','website'];
    protected $casts = ['app' =>'boolean','website'=>'boolean','title'=>'array','content'=>'array','published_at'=>'datetime','end_at'=>'datetime'];
    protected $dates = ['end_at'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getEndAttribute()
    {
        return date('d/m/Y', strtotime($this->end_at));
    }

    public function getPublishedAttribute()
    {
        return date('d/m/Y', strtotime($this->published_at));
    }
    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date($value,true),
//            set: fn ($value) => date($value),
        );
    }
    protected function endAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date($value,true),
//            set: fn ($value) => date($value),
        );
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
