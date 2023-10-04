<?php

namespace Modules\Projects\Http\Controllers;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\ProjectItem;
use Modules\Projects\Entities\Task;
use Modules\Projects\Http\Requests\IndexRequest;
use Modules\Projects\Http\Requests\ProjectIndexRequest;
use OpenApi\Attributes\Items;

class ProjectsController extends ProjectModuleController
{

    public function __construct()
    {
        parent::__construct();
        $this->class = "project";
        $this->table = "projects";
    }

    public function index(ProjectIndexRequest $request)
    {

        $input = $request->all();

        $projectName = $input['project_name'] ?? '';
        $responsableName = isset($input['responsable_name']) ?? '';

        $notAssignedProjects = Project::notDone()->notAssigned();
        $assignedProjects  = Project::notDone()->assigned();

        $requiredProjects = Project::notDone()->count();
        $finishedProjects  = Project::done()->count();

        if($projectName != ""){
            $notAssignedProjects->where('name','like', '%'.$projectName.'%');
            $assignedProjects->where('name','like', '%'.$projectName.'%');
        }
        if($responsableName != ""){
            $notAssignedProjects->whereHas('responsable',function($query)
            {$query->where('name','like', '%'.$responsableName.'%');}
             );
            $assignedProjects->whereHas('responsable',function($query)
            {$query->where('name','like', '%'.$responsableName.'%');}
            );
        }

        $notAssignedProjects = $notAssignedProjects->latest();
        $notAssignedProjects = $notAssignedProjects->get();

        $assignedProjects = $assignedProjects->latest();
        $assignedProjects = $assignedProjects->get();


        $class = $this->class;
        $title = __("Projects");
        $tree = $this->tree ;

        return view('projects::projects.index', compact('notAssignedProjects' , 'assignedProjects', 'title',  'class' , 'finishedProjects','requiredProjects','tree'));
    }
    public function create($step = 1, $id = null)
    {
        $class = $this->class;
        $users = $this->getClients();
        $countries = $this->getCountries(true);
        $project_id = $id;
        $experiences = $courses = [];
        if($id) {
            // $experiences = Experience::where('employee_id', $id)->get();
            // $courses = Course::where('employee_id', $id)->get();
        }
        return view('projects::projects.create', compact('class','step','countries', 'project_id'));
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
    public function show(int $id)
    {
        $project = Project::with(['tasks' => function($query) {
            $query->with('users');
        } ,'messages' => function($query) {
            $query->with('from');
        } , 'client','contract','responsible'])
            ->withCount('doneTasks','reqTasks')->findOrFail($id);

        $this->authorize('view', $project);

//        $tasksIds = $project->tasks->pluck('id');

        $tasks = $project->tasks;

//        $project->setAttribute('progress',round($project->req_tasks_count / $project->tasks_count * 100 ) ) ;

//        $duration = 0 ;
//        foreach ($project->tasks as $task){
//            $duration += $task->x ;
//        }

//        $project->setAttribute('duration',$duration) ;
        $tree = array_merge($this->tree, [route('admin.projects.index') => 'projects']);

        return view('projects::projects.project' ,compact('project' ,'tasks','tree' ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('projects::projects.edit');
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

    public function workspace($id)
    {

        $project = Project::select(['id','name'])->whereId($id)->first();

        return view('projects::projects.workspace', compact('project'));
    }


}
