<?php

namespace App\Models\Hr;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends MainModel
{
    use HasFactory;

    protected $fillable = ['employee_id','name','phone','type'];
}
