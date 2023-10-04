<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class BannerController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->class = "banner";
        $this->table = "banners";

        $this->middleware("auth");
        $this->middleware('permission:platforms.banners.view', ['only' => ['index']]);
        $this->middleware('permission:platforms.banners.create', ['only' => ['create']]);
        $this->middleware('permission:platforms.banners.edit', ['only' => ['edit']]);
    }

    public function index(){
        $tree = $this->tree;
        return view('admin.settings.platforms.banners.index', compact('tree'));
    }

    public function create()
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.banners.index') => 'banners-setting']);
        return view('admin.settings.platforms.banners.create', compact('tree'));
    }

    public function edit(string $id)
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.banners.index') => 'banners-setting']);
        return view('admin.settings.platforms.banners.create', compact('tree','id'));
    }

}
