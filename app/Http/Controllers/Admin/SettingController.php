<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\CMS\CompanyProject;
use Illuminate\Http\Request;

class SettingController extends MainController
{
   public function __construct()
   {
       parent::__construct();
       $this->middleware('auth');
       $this->middleware('permission:dashboardSetting.view', ['only' => ['dashboard']]);
       $this->middleware('permission:dashboardSetting.branches', ['only' => ['branches']]);
       $this->middleware('permission:dashboardSetting.branches.officialPaper', ['only' => ['papers']]);
       $this->middleware('permission:dashboardSetting.shift.view', ['only' => ['shift_settings_index']]);
       $this->middleware('permission:dashboardSetting.shift.create', ['only' => ['shift_settings_create']]);
       $this->middleware('permission:platforms.view', ['only' => ['platforms']]);
       $this->middleware('permission:platforms.mainPage.edit', ['only' => ['mainPage']]);

   }

   public function dashboard(){
       $tree = $this->tree ;
       return view('admin.settings.dashboard.index',compact('tree'));
   }

    public function branches(){
        $tree = array_merge($this->tree, [route('admin.settings.dashboard') => 'dashboard-setting']);
        return view('admin.settings.dashboard.branches',compact('tree'));
    }

    public function papers(){
        $tree = array_merge($this->tree, [route('admin.settings.dashboard') => 'dashboard-setting']);
        return view('admin.settings.dashboard.papers.index',compact('tree'));
    }


    public function shift_settings_index(){
        $tree = array_merge($this->tree, [route('admin.settings.dashboard') => 'dashboard-setting']);
        return view('admin.settings.dashboard.shifts.index',compact('tree'));
    }

    public function shift_settings_create($shift_id = null){
        $tree = array_merge($this->tree, [route('admin.settings.dashboard') => 'dashboard-setting']);
        return view('admin.settings.dashboard.shifts.create',compact('tree','shift_id'));
    }

    public function universities($shift_id = null){
        $tree = array_merge($this->tree, [route('admin.settings.dashboard') => 'dashboard-setting']);
        return view('admin.settings.dashboard.shifts.create',compact('tree','shift_id'));
    }


    public function attendance(){
        $tree = array_merge($this->tree, [route('admin.settings.dashboard') => 'dashboard-setting']);
        return view('admin.settings.dashboard.attendance',compact('tree'));
    }

    public function platforms(){
        $tree = $this->tree ;
        return view('admin.settings.platforms.index',compact('tree'));
    }

    public function mainPage(){
        $tree = array_merge($this->tree, [route('admin.settings.platforms') => 'platforms-setting']);
        return view('admin.settings.platforms.main-page',compact('tree'));
    }




}
