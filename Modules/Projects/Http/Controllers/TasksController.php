<?php

namespace Modules\Projects\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\Task;

class TasksController extends ProjectModuleController
{

    public function __construct()
    {
        parent::__construct();
        $this->class = "tasks";
        $this->table = "tasks";
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $projectName = isset($input['project_name']) ? $input['name'] : '';
        $responsableName = isset($input['responsable_name']) ? (int) $input['responsable_name'] : '';

        $data_all = Project::whereNull('done_at') ;
        if($projectName != ""){
            $data_all->where('name','like', '%'.$projectName.'%');
        }
        if($responsableName != ""){
            $data_all->whereHas('responsable',function($query)
            {$query->where('name','like', '%'.$projectName.'%');}
            );
        }

        $data =$data_all->latest();
        $data = $data_all->paginate($this->limit);
        $class = $this->class;
        $title = __("Projects");
        $route_create = $this->checkPerm("projects.create");
        $route_edit = $this->checkPerm("projects.edit");
        $tree = $this->tree ;
        return view('projects::projects.index', compact('data', 'title', 'route_create', 'route_edit', 'class','tree'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('projects::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $task = Task::with('status','childrens')->findOrFail($id);
        $tree = array_merge($this->tree, [route('admin.projects.index') => 'projects']);

        return view('projects::tasks.show',compact('task','tree'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('projects::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function assign(Task $task)
    {
        return view('projects::tasks.assign',compact('task'));
    }

    public function assignGo(Request $request,Task $task)
    {
        $task->users()->sync($request->get('usersIds'));
        return view('projects::tasks')->with('how to dat');
    }
}
