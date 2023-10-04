<?php

namespace App\Services;


use App\Services\FCM\FCMService;
use App\Traits\AdminHelperTrait;
use App\Traits\AdminTrait;
use App\Traits\HelperTrait;

class MainService
{
    use AdminTrait ,AdminHelperTrait ,HelperTrait;

    protected $fcmService;

    public function __construct() {
        $this->fcmService = new FCMService();
    }
}
