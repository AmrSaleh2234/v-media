<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class IconController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->class = "icon";
        $this->table = "icons";

        $this->middleware("auth");
        $this->middleware('permission:platforms.icons.view', ['only' => ['index']]);
        $this->middleware('permission:platforms.icons.create', ['only' => ['create']]);
        $this->middleware('permission:platforms.icons.edit', ['only' => ['edit']]);
    }

    public function index(){
        $tree = $this->tree;
        return view('admin.settings.platforms.icons.index', compact('tree'));
    }

    public function create()
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.icons.index') => 'icons-setting']);
        return view('admin.settings.platforms.icons.create', compact('tree'));
    }

    public function edit(string $id)
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.icons.index') => 'icons-setting']);
        return view('admin.settings.platforms.icons.create', compact('tree','id'));
    }

}
