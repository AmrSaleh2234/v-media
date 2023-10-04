<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ListRequest;
use App\Http\Resources\CMS\CompanyProjectResource;
use App\Http\Resources\CMS\ServiceResource;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\Page;
use App\Models\CMS\Section;
use App\Models\CMS\Service;
use App\Services\CMS\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends ApiController
{

    public function __construct(ServiceService $service)
    {
        parent::__construct();
        $this->service = $service;
//        $this->middleware('permission:service');
    }


    public function list(ListRequest $request)
    {
        $input = $request->all();
        if ($request->header('from') == 'application') {
            return $this->successResponse(ServiceResource::collection($this->service->search($input['keywords'] ?? null)
                ->app()
                ->orderBy($input['orderBy'] ?? $this->orderBy,( $input['orderDesc'] ?? $this->orderDesc ) ? 'desc' : 'asc')
                ->paginate($input['limit'] ?? $this->limit )));
        } elseif ($request->header('from') == 'website') {
            return $this->successResponse(ServiceResource::collection($this->service->search($input['keywords'] ?? null)
                ->website()
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
            $services = Service::app()->get();

        } elseif ($request->header('from') == 'website') {
            $services = Service::website()->get();
        }
        $data = ServiceResource::collection($services);
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
            $service = Service::app()->where('id',$id)->first();

        } elseif ($request->header('from') == 'website') {
            $service = Service::website()->where('id',$id)->first();
        }
        $data = new ServiceResource($service);
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


    public function servicePage(Request $request) {

        $lang = $request->header('lang');

        if(empty($lang)) {
            $lang = 'ar';
        }


        $sectionPage = Page::where('name', 'like', '%service%')->first();
        if($sectionPage == null) {
            return $this->errorResponse('No Service Page', 500);
        }

        $sections = Section::where('page_id', $sectionPage->id)->get();
        if(count($sections) == 0) {
            return $this->errorResponse('No Service Sections', 500);
        }

     $response = [];
        foreach($sections->pluck('value') as $line) {

            $services = Service::whereIn('id', $line["services"])->get();
            $arr = [
                "title" => $line['title'][$lang],
                "description" => $line['description'][$lang],
                "design" => $line['design'],
                "services" => ServiceResource::collection( $services),
            ];
          array_push($response, $arr);
        }

        return $this->successResponse($response);

    }
}
