<?php

namespace App\Models\Hr;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['name','type','management_id','manager_id','parent_id','note','active'];


    public function management() {
        return $this->belongsTo(Management::class);
    }



}
