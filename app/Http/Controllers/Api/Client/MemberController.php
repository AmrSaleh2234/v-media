<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ListRequest;
use App\Http\Resources\CMS\MemberResource;
use App\Models\CMS\Member;
use App\Services\CMS\MemberService;

use Illuminate\Http\Request;

class MemberController extends ApiController
{

    public function __construct(MemberService $service)
    {
        parent::__construct();
        $this->service = $service;
//        $this->middleware('permission:service');
    }


    public function list(ListRequest $request)
    {
        $input = $request->all();
        if ($request->header('from') == 'application') {
            return $this->successResponse(MemberResource::collection($this->service->search($input['keywords'] ?? null)
                ->app()
//                ->with('category')
                ->orderBy($input['orderBy'] ?? $this->orderBy,( $input['orderDesc'] ?? $this->orderDesc ) ? 'desc' : 'asc')
                ->paginate($input['limit'] ?? $this->limit )));
        } elseif ($request->header('from') == 'website') {
            return $this->successResponse(MemberResource::collection($this->service->search($input['keywords'] ?? null)
                ->website()
//                ->with('category')
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
            $members = Member::app()->get();

        } elseif ($request->header('from') == 'website') {
            $members = Member::website()->get();
        }
        $data = MemberResource::collection($members);
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
            $member = Member::app()->where('id',$id)->first();

        } elseif ($request->header('from') == 'website') {
            $member = Member::website()->where('id',$id)->first();
        }
        if (empty($member)){
            $data = new MemberResource($member);
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
