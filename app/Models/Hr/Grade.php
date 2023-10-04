<?php

namespace App\Models\Hr;

use App\Models\MainModel;
use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends MainModelSoft
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'name', 'active', 'description'
    ];

    public function jobGrades() {
        return $this->hasMany(JobGrade::class);
    }



}
