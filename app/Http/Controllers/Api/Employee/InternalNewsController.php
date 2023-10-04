<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Api\ApiController;
use App\Http\Livewire\Managements\Forms\Management;
use App\Http\Resources\InternalNewsResource;
use App\Models\Employee\Employee;
use App\Models\Hr\Department;
use App\Models\InternalNews;
use Illuminate\Http\Request;

class InternalNewsController extends ApiController
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index() {
        $employee = Employee::where([
            'user_id' => auth('api')->user()->id,
            'draft' => 0
        ])->with('workAt')->first();

        $mgmt_id = 0;
        $dep_id = 0;

         if ($employee->workAt?->workable instanceof Management) {
            $mgmt_id = $employee->workAt?->workable?->id;
         } else if ($employee->workAt?->workable instanceof Department) {
            $dep_id = $employee->workAt?->workable?->id;
            $mgmt_id = $employee->workAt?->workable?->management?->id;
         }

        $InternalNews = InternalNews::where('active',1)->where(['management_id' => $mgmt_id,
        'department_id' => $dep_id])->latest()->get();
        return $this->successResponse(InternalNewsResource::collection($InternalNews));
    }
}
