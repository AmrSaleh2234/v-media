<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ListRequest;
use App\Http\Resources\CMS\CompanyProjectResource;
use App\Http\Resources\CMS\NewsResource;
use App\Http\Resources\CMS\ServiceResource;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\News;
use App\Models\CMS\Service;
use App\Services\CMS\NewsService;
use App\Services\CMS\ServiceService;
use Illuminate\Http\Request;

class NewsController extends ApiController
{

    public function __construct(NewsService $service)
    {
        parent::__construct();
        $this->service = $service;
//        $this->middleware('permission:service');
    }


    public function list(ListRequest $request)
    {
        $input = $request->all();
        if ($request->header('from') == 'application') {
            return $this->successResponse(NewsResource::collection($this->service->search($input['keywords'] ?? null)
                ->app()
                ->notEnded()
                ->with('category')
                ->orderBy($input['orderBy'] ?? $this->orderBy,( $input['orderDesc'] ?? $this->orderDesc ) ? 'desc' : 'asc')
                ->paginate($input['limit'] ?? $this->limit )));
        } elseif ($request->header('from') == 'website') {
            return $this->successResponse(NewsResource::collection($this->service->search($input['keywords'] ?? null)
                ->website()
                ->notEnded()
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
        if ($request->header('from') == 'application') {
            $news = News::app()->published()->notEnded()->get();

        } elseif ($request->header('from') == 'website') {
            $news = News::website()->published(timezone($request->ip()))->notEnded()->get();
        }
        $data = NewsResource::collection($news);
        return $this->successResponse($data,now(timezone($request->ip())));
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
            $news = News::app()->published()->notEnded()->where('id',$id)->first();

        } elseif ($request->header('from') == 'website') {
            $news = News::website()->published()->notEnded()->where('id',$id)->first();
        }
        $data = new NewsResource($news);
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
