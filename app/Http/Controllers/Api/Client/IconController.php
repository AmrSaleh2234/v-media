<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ListRequest;
use App\Http\Resources\CMS\CompanyProjectResource;
use App\Http\Resources\CMS\NewsResource;
use App\Http\Resources\CMS\IconResource;
use App\Http\Resources\CMS\ServiceResource;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\News;
use App\Models\CMS\Icon;
use App\Models\CMS\Service;
use App\Services\CMS\IconService;
use App\Services\CMS\PartnerService;
use App\Services\CMS\ServiceService;
use Illuminate\Http\Request;

class IconController extends ApiController
{

    public function __construct(IconService $service)
    {
        parent::__construct();
        $this->service = $service;
//        $this->middleware('permission:service');
    }


    public function list(ListRequest $request)
    {
        $input = $request->all();
        if ($request->header('from') == 'application') {
            return $this->successResponse(IconResource::collection($this->service->search($input['keywords'] ?? null)
                ->app()
                ->orderBy($input['orderBy'] ?? $this->orderBy,( $input['orderDesc'] ?? $this->orderDesc ) ? 'desc' : 'asc')
                ->paginate($input['limit'] ?? $this->limit )));
        } elseif ($request->header('from') == 'website') {
            return $this->successResponse(IconResource::collection($this->service->search($input['keywords'] ?? null)
                ->website()
                ->with('category')
                ->orderBy($input['orderBy'] ?? $this->orderBy,( $input['orderDesc'] ?? $this->orderDesc ) ? 'desc' : 'asc')
                ->paginate($input['limit'] ?? $this->limit )));
        }
        return $this->errorResponse();
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->all();
        $query = Icon::query();
        if ($request->header('from') == 'application') {
            $query = $query->app();
        } elseif ($request->header('from') == 'website') {
            $query = $query->website();
        }
        $icons = $query->when(!empty($type),function ($q) use ($type){
            $q->where('type',$type);
        })->get();
        $data = IconResource::collection($icons);
        return $this->successResponse($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        return $this->successResponse();
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
    public function show(Request $request,string $id)
    {
        if ($request->header('from') == 'application') {
            $partner = Icon::app()->where('id',$id)->first();

        } elseif ($request->header('from') == 'website') {
            $partner = Icon::website()->where('id',$id)->first();
        }
        if ($partner){
            $data = new IconResource($partner);
            return $this->successResponse($data);
        }else{
            return $this->errorResponse('Not found',404);
        }
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
