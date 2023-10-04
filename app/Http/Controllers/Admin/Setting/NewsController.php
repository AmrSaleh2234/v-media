<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class NewsController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->class = "news";
        $this->table = "news";

        $this->middleware("auth");
        $this->middleware('permission:platforms.news.view', ['only' => ['index']]);
        $this->middleware('permission:platforms.news.create', ['only' => ['create']]);
        $this->middleware('permission:platforms.news.edit', ['only' => ['edit']]);
    }

    public function index(){
        $tree = $this->tree;
        return view('admin.settings.platforms.news.index', compact('tree'));
    }

    public function create()
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.news.index') => 'news-setting']);
        return view('admin.settings.platforms.news.create', compact('tree'));
    }

    public function show(string $id)
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.news.index') => 'news-setting']);
        return view('admin.settings.platforms.news.create', compact('tree','id'));
    }

    public function edit(string $id)
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.news.index') => 'news-setting']);
        return view('admin.settings.platforms.news.create', compact('tree','id'));
    }

}
