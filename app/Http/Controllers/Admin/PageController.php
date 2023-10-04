<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\CMS\CompanyProject;
use Illuminate\Http\Request;

class PageController extends MainController
{
   public function __construct()
   {
       parent::__construct();
   }

    public function mainPage(){
        $tree = array_merge($this->tree, [route('admin.settings.platforms') => 'website-setting']);
        return view('admin.settings.website.main-page',compact('tree'));
    }
    public function aboutUs(){
        $tree = array_merge($this->tree, [route('admin.settings.platforms') => 'website-setting']);
        return view('admin.settings.website.about-us',compact('tree'));
    }

    public function contactUs(){
        $tree = array_merge($this->tree, [route('admin.settings.platforms') => 'website-setting']);
        return view('admin.settings.website.contact-us',compact('tree'));
    }


    public function servicePage() {
        $tree = array_merge($this->tree, [route('admin.settings.platforms') => 'website-setting']);
        return view('admin.settings.website.service-page',compact('tree'));
    }



}
