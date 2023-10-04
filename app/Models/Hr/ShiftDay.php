<?php

namespace App\Models\Hr;

use App\Models\MainModelSoft;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShiftDay extends MainModelSoft
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['shift_id','day_name','start_in','end_in','active','late_start_in', 'early_start_in'];

    public function shift() {
        return $this->belongsTo(\App\Models\Hr\Shift::class);
    }
}
