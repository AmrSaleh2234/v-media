<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ListRequest;
use App\Http\Resources\CMS\CompanyProjectResource;
use App\Http\Resources\CMS\ProjectTypeResource;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\ProjectType;
use App\Services\CMS\CompanyProjectService;
use Illuminate\Http\Request;

class CompanyProjectController extends ApiController
{
    public function __construct(CompanyProjectService $service)
    {
        parent::__construct();
        $this->service = $service;
//        $this->middleware('permission:service');
    }

    public function list(ListRequest $request)
    {
        $input = $request->all();
        if ($request->header('from') == 'application') {
            return CompanyProjectResource::collection(
                $this->service->search($input['keywords'] ?? null)
                    ->app()
                    ->with(['services', 'projectType'])
                    ->orderBy($input['orderBy'] ?? $this->orderBy, ($input['orderDesc'] ?? $this->orderDesc) ? 'desc' : 'asc')
                    ->paginate($input['limit'] ?? $this->limit));

        } elseif ($request->header('from') == 'website') {
            return CompanyProjectResource::collection(
                $this->service->search($input['keywords'] ?? null)
                    ->website()
                    ->with(['services', 'projectType'])
                    ->orderBy($input['orderBy'] ?? $this->orderBy, ($input['orderDesc'] ?? $this->orderDesc) ? 'desc' : 'asc')
                    ->paginate($input['limit'] ?? $this->limit));
        }
        return $this->errorResponse();

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->header('from') == 'application') {
            $projects = CompanyProject::app()->with(['attachments' => fn($q) => $q->where('type',  'main_image_app'), 'projectType', 'services'])->get();
            $projectTypes = ProjectTypeResource::collection(ProjectType::whereHas('companyProjects',fn($q)=>$q->where('app',1))->get());

        } elseif ($request->header('from') == 'website') {
            $projects = CompanyProject::website()->with(['attachments' => fn($q) => $q->where('type', 'main_image'), 'projectType', 'services'])->get();
            $projectTypes = ProjectTypeResource::collection(ProjectType::whereHas('companyProjects',fn($q)=>$q->where('website',1))->get());
        }
        $data = CompanyProjectResource::collection($projects);
        return $this->successResponse(['projects' => $data, 'projectTypes' => $projectTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        if ($request->header('from') == 'application') {
            $data = new CompanyProjectResource(CompanyProject::app()->with(['attachments'=>fn($q)=>$q->whereIn('type',['main_image_app_show','sub_image1_app_show','sub_image2_app_show','sub_image3_app_show','sub_image4_app_show'])
                ,'services', 'projectType'])->findOrFail($id));
        } elseif ($request->header('from') == 'website') {
            $data = new CompanyProjectResource(CompanyProject::website()->with([ 'attachments'=>fn($q)=>$q->whereIn('type',['main_image','sub_image1','sub_image2','sub_image3','sub_image4'])
                ,'services', 'projectType'])->findOrFail($id));
        }
        return $this->successResponse($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
