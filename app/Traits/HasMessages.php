<?php

namespace App\Traits;

use App\Models\Message;

trait HasMessages
{
    public function messages()
    {
        return $this->morphMany(Message::class,'messageable');
    }

    public function lastMessages()
    {
        return $this->morphMany(Message::class,'messageable')->latest();
    }

    public function lastMessage()
    {
        return $this->morphMany(Message::class,'messageable',)->latest()->limit(1);
    }
}
