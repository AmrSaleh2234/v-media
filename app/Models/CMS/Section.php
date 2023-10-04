<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends MainModelSoft
{
    protected $fillable = ['key','value','page_id','app','website'];

    protected $casts = ['value' => 'array' ];

    public function page()
    {
      return  $this->belongsTo(Page::class);
    }

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }



}
