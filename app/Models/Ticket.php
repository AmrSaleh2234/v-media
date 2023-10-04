<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Ticket extends MainModelSoft
{
    protected $fillable = ['title', 'type', 'data', 'status_id', 'priority', 'has_ticket_id', 'has_ticket_type', 'response', 'note', 'resolved'];

    protected $casts = ['data' => 'array', 'resolved' => 'boolean'];

    public function owner()
    {
        return $this->morphTo();
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
