<?php

namespace App\Models;

use App\Models\Hr\Department;
use App\Models\Hr\Management;

class InternalNews extends MainModelSoft
{
    protected $fillable = ["title", "management_id", "department_id", "attachment", "active"];

    protected $casts = ['title' => 'array'];

    public function management() {
        return $this->hasOne(Management::class, "id", "management_id");
    }

    public function department() {
        return $this->hasOne(Department::class, "id", "department_id");
    }

 
}
