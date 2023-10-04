<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends MainModelSoft
{
    protected $fillable = ['email','channel','active','from'];

}
