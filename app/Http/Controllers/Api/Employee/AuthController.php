<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientCompanyResource;
use App\Http\Resources\ClientIdvividualResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\UserResource;
use App\Models\Client;
use App\Models\Device;
use App\Models\Employee\Employee;
use App\Models\Hr\Branch;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:api', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
        $imei = $token = $device_type = NULL;

        $rules = [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
            'imei' => 'required|string',
            'device_token' => 'required|string',
            'device_type' => 'required|string|in:android,ios',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }
        $input = $request->only(['email', 'password', 'imei', 'device_token', 'device_type']);
        $user = \App\Models\User::with('employee')->where('email', $input['email'])->first();

        if (!$user || !Hash::check($input['password'], $user->password)) {
            return $this->errorResponse('wrong email or password', 401);
        }

        if (!$user->active) {
            return $this->errorResponse('user Suspended contact admin for more', 403);
        }

        if (!$user->employee) {
            return $this->errorResponse('user is not a employee', 405);
        }

        if ($user->employee->draft) {
            return $this->errorResponse('Employee Is Draft', 406);
        }

        Device::updateDevice($user->id, 'users', $input['imei'], $input['device_token'], $input['device_type']);

//        $data = (object)[];
        $token = $user->createToken('employee', ['employee'])->accessToken;
        $data = ['user' => new UserResource($user), 'token' => $token];

        return $this->successResponse($data);
    }

    public function support(Request $request)
    {
        $rules = [
            'card_id' => 'required|numeric',
            'type' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'note' => 'required|string',
            'imei' => 'nullable|string',
            'device_token' => 'nullable|string',
            'device_type' => 'nullable|string|in:android,ios',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }
        $input = $request->only(['card_id', 'name', 'phone', 'note','type', 'imei', 'device_token', 'device_type']);

        $employee = Employee::draft(0)->wherehas('info',fn($q)=> $q->where('id_number',$input['card_id']) )->first();
//        if (!$employee){
//            return $this->errorResponse('No Employee with this ID');
//        }
        $statusId = Status::where('type','tickets')->where('name','pending')->value('id');

        Ticket::create([
            'title' => $input['type'],
            'type' => 'password',
            'data' => ['name'=>$input['name'],'phone'=>$input['phone'],'id'=>$input['card_id']],
            'note'=>$input['note'],
            'status_id'=>$statusId,
            'has_ticket_id' => $employee?->id ,
            'has_ticket_type'=> $employee ?'employees' : null
        ]);

//        $user = User::active()->whereId(auth('api')->id())->first();
        return $this->successResponse('Ticket Created Successfully');
    }


    public function logout(Request $request)
    {
        // $request->user()->token()->revoke();

        $user = auth('api')->user();
        if ($user && $user->token()) {
            $token = $user->token();
            $token->revoke();
            $token->delete();
            //   Activity::log('user\logout', $user);
            return $this->successResponse(['message' => 'logged out !']);
        } else {
            return $this->errorResponse(['message' => 'no user !']);

        }
    }

}
