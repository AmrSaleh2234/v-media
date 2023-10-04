<?php

namespace App\Models\CMS;

use App\Models\MainModelSoft;
use App\Models\Status;

class ServiceRequest extends MainModelSoft
{
    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'from', 'response', 'service_id', 'status_id'];

    public function service()
    {
        return $this->belongsTo(\App\Models\CMS\Service::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
