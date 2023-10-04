<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends MainModelSoft
{

    protected $table = 'services';
    protected $fillable = [ 'link', 'name', 'image', 'icon','files', 'category_id', 'order_id', 'details', 'description','short_description', 'is_featured', 'app', 'website'];
    protected $casts = ['details' => 'array', 'name' => 'array', 'description' => 'array','files'=>'array', 'app' => 'boolean', 'website' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function childrens()
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_id')->withTrashed();
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function companyProjects()
    {
        return $this->belongsToMany(CompanyProject::class, 'company_project_service', 'company_project_id', 'service_id')->withPivot(['id','zone','file'])->withTimestamps();
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
    protected function shortDescription(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    }

    protected function files(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    }

}
