<?php

namespace App\Models;

use App\Models\Hr\Branch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRequest extends MainModelSoft
{
    protected $fillable = [
        'name', 'email', 'phone', 'from', 'branch_id', 'status_id','image',
        'card_id', 'card_image', 'note', 'type', 'register_number', 'register_image', 'agent_name', 'letter_head',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    }
}
