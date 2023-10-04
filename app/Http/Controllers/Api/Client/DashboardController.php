<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\ClientCompanyResource;
use App\Http\Resources\ClientIdvividualResource;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Projects\Entities\Contract;

class DashboardController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api-client');
    }

    public function index(Request $request)
    {
        return $this->successResponse(true,__('names.client-gate'));
    }

    public function profile(Request $request)
    {
        $title = __("names.client-data");
        $class = $this->class;
        $client =auth('api-client')->user();

        $data_all = Contract::where('client_id',$client->id)->latest();
        $contracts = $data_all->get();
        $statuses = DB::table('contracts')->leftJoin('statuses','statuses.id','=','contracts.status_id')->select(DB::raw('count(*) as total, statuses.name as status, statuses.color as color', 'statuses.id as id'))->groupBy('status_id')->get();

//        $payments = ContractPayment::whereIn('contract_id',$data_all->pluck('id'))->sum('amount');
        $payments = [
          'total' => 10000,
          'paid' => 5000,
            'due' =>1000,
          'late' => 4000
        ];
//        $logs = $client->activities;
      return $this->successResponse(['contracts'=> $contracts,'statuses'=>$statuses,'payments'=>$payments]);
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
        $user =  \auth('api-client')->user();
        $notifications = $user->notifications;
        return $this->successResponse($notifications);
    }

    public function markAsRead()
    {
        $user =  auth('api-client')->user();
        $user->unreadNotifications->markAsRead();
        $notifications = $user->notifications;
        return $this->successResponse($notifications);
    }

    public function unreadNotifications()
    {
        $user =  \auth('api-client')->user();
        $notifications = $user->unreadNotifications();
        return $this->successResponse($notifications);
    }

    public function deleteAccount()
    {
//        $user =  \auth()->user();
//        auth()->guard('api')->user();
        return $this->successResponse(auth('api-client')->user()->delete());
    }

    public function user()
    {
        $client = Client::with(['attachments'=>fn($q)=>$q->where('type','!=','image')->latest()->limit(1)])->whereId(auth('api-client')->id())->first();
        if ($client->type == 'company'){
            return $this->successResponse(new ClientCompanyResource($client));
        }
        return $this->successResponse(new ClientIdvividualResource($client));
    }

}
