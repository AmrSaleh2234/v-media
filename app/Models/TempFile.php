<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempFile extends Model
{
    use HasFactory;

    protected $fillable = ['folder','file'];

 public function scopeFolder($query ,$folder)
 {
     return $query->where('folder',$folder);
 }


}
