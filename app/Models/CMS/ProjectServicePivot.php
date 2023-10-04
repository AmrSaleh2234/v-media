<?php

namespace App\Models\CMS;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectServicePivot extends MainModel
{
    protected $fillable = ['company_project_id','service_id','zone','file'];
    protected $casts = ['zone'=>'array'];
    protected $table = 'company_project_service';

    protected function zone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

}
