<?php

namespace App\Models\GADA;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends MainModelSoft
{
    protected $fillable = ['content','type','active'];
    protected $casts = ['content' => 'array','active'=>'boolean'];

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    }
}
