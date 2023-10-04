<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends MainModelSoft
{
    protected $fillable = ['name', 'email', 'phone',  'telephone', 'contactable_id', 'contactable_type', 'status_id'];
}
