<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Banner extends MainModelSoft
{
    protected $table = 'banners';

    protected $fillable = ['name', 'link','type', 'image', 'description', 'order_id', 'app', 'website'];
    protected $casts = ['name' => 'array', 'description' => 'array'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('app-thumb')
            ->width(254)
            ->height(162);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    }

}
