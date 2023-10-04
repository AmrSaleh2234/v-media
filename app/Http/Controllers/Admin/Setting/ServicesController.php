<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class ServicesController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->class = "service";
        $this->table = "services";

         $this->middleware("auth");
        $this->middleware('permission:platforms.services.view', ['only' => ['index']]);
        $this->middleware('permission:platforms.services.create', ['only' => ['create']]);
        $this->middleware('permission:platforms.services.edit', ['only' => ['edit']]);
    }

    public function index(){
        $tree = $this->tree;
        return view('admin.settings.platforms.services.index', compact('tree'));
    }

    public function create()
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.services.index') => 'services-setting']);
        return view('admin.settings.platforms.services.create', compact('tree'));
    }

    public function edit(string $id)
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.services.index') => 'services-setting']);
        return view('admin.settings.platforms.services.create', compact('tree','id'));
    }

}
