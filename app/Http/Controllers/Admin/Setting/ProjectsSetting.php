<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Models\CMS\CompanyProject;
use Illuminate\Http\Request;

class ProjectsSetting extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->class = "project";
        $this->table = "projects";

         $this->middleware("auth");
        $this->middleware('permission:platforms.projects.view', ['only' => ['index']]);
        $this->middleware('permission:platforms.projects.create', ['only' => ['create']]);
        $this->middleware('permission:platforms.projects.edit', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $project = CompanyProject::find(1);
//        $url = public_path('assets/images/project.jpg');
//        $project
//            ->addMedia($url)
//            ->toMediaCollection('main-page','uploads');
        $tree = $this->tree;
        $this->lang = auth()->user()->lang;

        return view('admin.settings.platforms.projects.index', compact('tree'))->with(['lang'=> $this->lang]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tree = array_merge($this->tree, [route('admin.settings.platforms.projects.index') => 'projects-setting']);
        return view('admin.settings.platforms.projects.create', compact('tree'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $companyProject = CompanyProject::findOrFail($id);
        $tree = array_merge($this->tree, [route('admin.settings.platforms.projects.index') => 'projects-setting']);
        return view('admin.settings.platforms.projects.create', compact('tree',))->with(['id'=>$companyProject->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }
}
