<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends MainModelSoft
{
    protected $fillable = ['name','type','color'];

    public function client(){
        return $this->hasMany(Client::class);
    }

}
