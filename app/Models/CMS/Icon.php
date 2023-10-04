<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icon extends MainModelSoft
{
    protected $fillable = ['name','logo','type','link','app','website'];
    protected $casts = ['name'=>'array'];

    public static array $types = ['partners','certificates','credences'];
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

}
