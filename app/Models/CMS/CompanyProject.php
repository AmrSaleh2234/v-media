<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class CompanyProject extends MainModelSoft
{
    protected $table = 'company_projects';
    protected $fillable = ['name','title','description','link','details','main_image','project_type_id','is_featured','app','website'];
//    protected $casts = ['name'=>'array','title'=>'array','description'=>'array'];

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class,'company_project_service','service_id','company_project_id')->withPivot(['zone','file'])->withTimestamps();
    }

    public function pivots()
    {
        return $this->hasMany(ProjectServicePivot::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('app-thumb')
            ->width(135)
            ->height(72)
            ->nonQueued();
//            ->queued();

        $this->addMediaConversion('app-show-thumb')
            ->width(351)
            ->height(187)
            ->nonQueued();

    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function getPath(Media $media) : string
    {
        if ($media instanceof CompanyProject) {
            return 'company-projects/' . $media->user_id . '/' . $media->id;
        }
        return $media->id;
    }

}
