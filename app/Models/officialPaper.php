<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class officialPaper extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['name', 'duration', 'status', 'way_to_send'];

}
