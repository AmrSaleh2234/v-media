<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

class InternalNewsController extends MainController
{
    public function __construct() {
        parent::__construct();

        $this->middleware('auth');

        $this->middleware('permission:platforms.intrenalNews.view', ['only' => ['index']]);
        $this->middleware('permission:platforms.intrenalNews.create', ['only' => ['create']]);
        $this->middleware('permission:platforms.intrenalNews.edit', ['only' => ['edit']]);
    }

    public function index() {
        $tree = $this->tree;
        return view('admin.settings.platforms.internal_news.table')->with('tree', $tree);
    }

    public function create() {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.internal-news.index') => 'internal-news']);
        return view('admin.settings.platforms.internal_news.form')->with('tree', $tree);
    }

    public function edit($id) {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.internal-news.index') => 'internal-news']);
        return view('admin.settings.platforms.internal_news.form')->with(['tree' => $tree, 'id' => $id]);
    }
}
