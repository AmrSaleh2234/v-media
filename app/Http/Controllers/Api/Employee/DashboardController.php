<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\ClientCompanyResource;
use App\Http\Resources\ClientIdvividualResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\NotificationsResource;
use App\Http\Resources\UserResource;
use App\Models\Client;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Projects\Entities\Contract;

class DashboardController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        return $this->successResponse(true,__('names.employee-gate'));
    }

    public function profile(Request $request)
    {
        $user = auth('api')->user();

      return $this->successResponse(['user'=> $user,]);
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'agent_name' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'card_image' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'register_image' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'letter_head' => 'nullable|string'
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $input = $request->only(['name','agent_name','letter_head','image','register_image','card_image']);
        $id = auth('api-client')->id() ;
        $client = Client::with(['attachments'=>fn($q)=>$q->where('type','!=','image')->latest()->limit(1)])->whereId($id)->first() ;

        if ($request->hasFile('image') && isset($input['image'])){
            $input['image'] = uploadFile($request->file('image'),'clients',$id,'image',true);
        }
        if ($request->hasFile('register_image') && isset($input['register_image'])){
            $input['register_image'] = uploadFile($request->file('register_image'),'clients',$id,'register_image',true);
        }
        if ($request->hasFile('card_image') && isset($input['card_image'])){
            $input['card_image'] = uploadFile($request->file('card_image'),'clients',$id,'card_image',true);
        }
//        return $this->successResponse($input);

        if ($client->update($input)){
            if ($client->type == 'company'){
                return $this->successResponse(new ClientCompanyResource($client));
            }
            return $this->successResponse(new ClientIdvividualResource($client));
        }else{
            return $this->errorResponse('not updated');
        }
    }

    public function notifications()
    {
        //   $notifications = \auth()->user()->notifications();
        $user =  \auth('api')->user();
        return $this->successResponse(NotificationsResource::collection($user->notifications));
    }

    public function markAsRead()
    {
        $user =  auth('api')->user();
        $user->unreadNotifications->markAsRead();
        $notifications = $user->notifications;
        return $this->successResponse($notifications);
    }

    public function unreadNotifications()
    {
        $user =  \auth('api')->user();
        $notifications = $user->unreadNotifications();
        return $this->successResponse($notifications);
    }

    public function deleteAccount()
    {
//        $user =  \auth()->user();
//        auth()->guard('api')->user();
        return $this->successResponse(auth('api')->user()->delete());
    }

    public function user()
    {
        $user = User::active()->whereId(auth('api')->id())->first();
        return $this->successResponse(new UserResource($user));
    }

//    public function notifications()
//    {
//        $user = User::active()->whereId(auth('api')->id())->first();
//        return $this->successResponse($user->notifications()->get());
//    }



}
