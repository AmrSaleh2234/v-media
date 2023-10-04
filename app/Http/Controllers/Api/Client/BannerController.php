<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ListRequest;
use App\Http\Resources\CMS\BannerResource;
use App\Models\CMS\Banner;
use App\Services\CMS\BannerService;
use Illuminate\Http\Request;

class BannerController extends ApiController
{
    public function __construct(BannerService $service)
    {
        parent::__construct();
        $this->service = $service;
//        $this->middleware('permission:service');
    }

    public function list(ListRequest $request)
    {
        $input = $request->all();
        if ($request->header('from') == 'application') {
            return BannerResource::collection($this->service->search($input['keywords'] ?? null)
                ->app()
                ->orderBy($input['orderBy'] ?? $this->orderBy,( $input['orderDesc'] ?? $this->orderDesc ) ? 'desc' : 'asc')
                ->paginate($input['limit'] ?? $this->limit ));
        } elseif ($request->header('from') == 'website') {
            return BannerResource::collection($this->service->search($input['keywords'] ?? null)
                ->website()
                ->orderBy($input['orderBy'] ?? $this->orderBy,( $input['orderDesc'] ?? $this->orderDesc ) ? 'desc' : 'asc')
                ->paginate($input['limit'] ?? $this->limit ));
        }
        return  $this->errorResponse();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->header('from') == 'application') {
            $banners = Banner::app()->get();
        } elseif ($request->header('from') == 'website') {
            $banners = Banner::website()->get();
        }
        $data = BannerResource::collection($banners);
        return $this->successResponse($data);
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
    public function show(Request $request,string $id)
    {
        if ($request->header('from') == 'application') {
            $banner = Banner::app()->where('id',$id)->first();
        } elseif ($request->header('from') == 'website') {
            $banner = Banner::website()->where('id',$id)->first();
        }
        if (!isset($banner) && !$banner){
            return $this->errorResponse('Not Found',404);
        }
        $data = new BannerResource($banner);
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
