<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends MainModelSoft
{

    protected $table = 'categories';

    protected $fillable = ['name', 'type','parent_id', 'active'];

    protected $casts = ['name' => 'array'];

    public static array $types= ['services','news']; // posts


    public function posts() {
        return $this->hasMany(Post::class)->withTrashed();
    }

    public function services() {
        return $this->hasMany(Service::class)->withTrashed();
    }

    public function childrens() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id')->withTrashed();
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

}
