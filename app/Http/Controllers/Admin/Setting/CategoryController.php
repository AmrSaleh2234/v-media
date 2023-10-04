<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class CategoryController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->class = "category";
        $this->table = "categories";

        $this->middleware("auth");
        $this->middleware('permission:platforms.categories.view', ['only' => ['index']]);
        $this->middleware('permission:platforms.categories.create', ['only' => ['create']]);
        $this->middleware('permission:platforms.categories.edit', ['only' => ['edit']]);
    }

    public function index(){
        $tree = $this->tree;
        return view('admin.settings.platforms.categories.index', compact('tree'));
    }

    public function create()
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.categories.index') => 'categories-setting']);
        return view('admin.settings.platforms.categories.create', compact('tree'));
    }

    public function edit(string $id)
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.categories.index') => 'categories-setting']);
        return view('admin.settings.platforms.categories.create', compact('tree','id'));
    }

}
