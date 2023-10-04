<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class WebsiteController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("auth");
        $this->middleware('permission:platforms.website.setting', ['only' => ['setting']]);
        $this->middleware('permission:platforms.website.reports', ['only' => ['reports']]);
    }

    public function setting(){
        $tree = array_merge($this->tree, [route('admin.settings.platforms') => 'website-setting']);
        return view('admin.settings.website.setting',compact('tree'));
    }



}
