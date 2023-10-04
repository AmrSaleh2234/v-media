<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeRequestResource;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeRequest;
use App\Models\Status;
use App\Models\User;
use App\Notifications\MainNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EmployeeRequestsController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function requests(Request $request)
    {
        $user = auth('api')->user();
        $id = Employee::where('user_id', auth('api')->id())->value('id');
        $requests = EmployeeRequest::with('status:id,name')->where('employee_id', $id)->get();
//        return $requests ;
        return $this->successResponse(EmployeeRequestResource::collection($requests));
    }

    public function createRequest(Request $request)
    {
        $rules = [
            'type' => 'required|string|in:remote,mission,overtime,late,checkoutPermission',
            'name' => 'required_if:type,mission|string',
            'responsible' => 'required_if:type,mission|string',
            'time_from' => 'required_if:type,mission|date',
            'time_to' => 'required_if:type,mission|date',

            'latitude' => 'required_if:type,mission|numeric',
            'longitude' => 'required_if:type,mission|numeric',
            'address' => 'required_if:type,mission|string',

//            'imei' => 'nullable|string',
//            'device_token' => 'nullable|string',
//            'device_type' => 'nullable|string|in:android,ios',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }
        $input = $request->all();
        $employee = Employee::draft(0)->where('user_id', auth('api')->id())->first();
        if (!$employee) {
            return $this->errorResponse('Employee not found');
        }


        if ($input['type'] != 'mission'){
            $input['name'] = __('names.'. $input['type']);
//          $input['responsible'] =    auth('api')->user()->name;// until migrate
        }

        $statusId = Status::where('type','employee-requests')->where('name','pending')->value('id');

        $oldReq = EmployeeRequest::where(['employee_id' => $employee->id, 'type' => $input['type']])->whereDate('created_at', Carbon::today())->first();
        if(!empty($oldReq)) {
            return $this->errorResponse('Request Already Created Before', 500);
        }
        if($input['type'] == 'mission') {
            $input['time_from'] = Date('Y-m-d h:i:s', strtotime($input['time_from']));
            $input['time_to'] = Date('Y-m-d h:i:s', strtotime($input['time_to']));
        } else if ($input['type'] == 'overtime') {
            $input['time_from'] = Date('Y-m-d h:i:s');
            $input['time_to'] = null;
        }  else {
            $input['time_from'] = Date('Y-m-d h:i:s');
            $input['time_to'] = Date('Y-m-d h:i:s',strtotime("+10 hours"));
        }
        $input['from'] = 'application';
        $input['employee_id'] = $employee->id;
        $input['status_id'] = $statusId;
        EmployeeRequest::create($input);
        $permissions = ['attendance.requests.changeStatus','attendance.requests.view'];
        $users = User::whereHas('permissions',fn($q)=>$q->whereIn('name',$permissions))
        ->orWhereHas('roles',fn($q)=>$q->whereHas('permissions',fn($q)=>$q->where('name',$permissions)))->get();
        $data = [];
        $data['from'] =  config('app.name');
        $data['message'] = 'الموظف ' . $employee->first_name .' أرسل طلب ' .  __('names.'.$input['type']);
        $data['url'] =      route('admin.attendance.requests.index');
        Notification::send($users, new MainNotification($data));

        return $this->successResponse('Request Received Successfully ');
    }


    //
}
