<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends MainModelSoft
{
    protected $fillable = ['name', 'color', 'group'];
    protected $casts = ['name' => 'array'];

    public function companyProjects()
    {
        return $this->hasMany(CompanyProject::class,'project_type_id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

}
