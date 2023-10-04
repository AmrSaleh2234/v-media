<?php

namespace App\Models;



use App\Models\Hr\Branch;

class Broker extends MainModelSoft
{

    protected $table = 'brokers';

    protected $fillable = ['name', 'phone', 'email', 'accounting_method' , 'percentage',
        'card_id', 'card_image', 'note', 'active'
    ];

    public function clients() {
        return $this->hasMany(Client::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }
}
