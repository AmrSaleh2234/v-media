<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class ReportsController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("auth");
        $this->middleware('permission:platforms.website.reports.contactUs', ['only' => ['contactUs']]);
        $this->middleware('permission:platforms.website.reports.services', ['only' => ['services']]);
        $this->middleware('permission:platforms.website.reports.subscribers', ['only' => ['subscribers']]);

    }

    public function contactUs(){
        $tree = array_merge($this->tree, [route('admin.settings.platforms') => 'website-setting',route('admin.settings.website.reports.contact-us') => 'reports']);
        return view('admin.settings.website.reports.contact-us',compact('tree'));
    }


    public function services(){
        $tree = array_merge($this->tree, [route('admin.settings.platforms') => 'website-setting',route('admin.settings.website.reports.contact-us') => 'reports']);
        return view('admin.settings.website.reports.services',compact('tree'));
    }

    public function subscribers(){
        $tree = array_merge($this->tree, [route('admin.settings.platforms') => 'website-setting',route('admin.settings.website.reports.contact-us') => 'reports']);
        return view('admin.settings.website.reports.subscribers',compact('tree'));
    }


}
