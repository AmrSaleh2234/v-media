<?php

namespace App\Traits;

use App\Models\Address;

trait HasAddress
{
    public function addresses()
    {
        return $this->morphMany(Address::class,'addressable');
    }

    public function lastAddresses()
    {
        return $this->morphMany(Address::class,'addressable')->latest();
    }

    public function lastAddress()
    {
        return $this->morphMany(Address::class,'addressable')->latest()->limit(1);
    }

    public function motherAddress()
    {
        return $this->morphOne(Address::class,'addressable');
    }
}
