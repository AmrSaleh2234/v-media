<?php

namespace App\Http\Controllers\Api\Client;


use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Resources\ClientCompanyResource;
use App\Http\Resources\ClientIdvividualResource;
use App\Models\Client;
use App\Models\ClientRequest;
use App\Models\Device;
use App\Models\Hr\Branch;
use App\Models\Status;
use App\Services\FCM\FCMService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:api-client', ['except' => 'logout']);
    }

    public function check(Request $request)
    {
        $imei = $token = $device_type = NULL;

        $rules = [
//            'card_id' => 'required_without:register_number|digits:10',
//            'register_number' => 'required_without:card_id|numeric',
            'id' => 'required|numeric',
            'imei' => 'required|string',
            'token' => 'required|string',
            'device_type' => 'required|string|in:android,ios',
            'type' => 'required|in:individual,company',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }
        $type = $request->get('type');
        $id = $request->get('id');
        $query = Client::query()->with(['status', 'branch']);
        if ($type == 'individual') {
            $query->where('card_id', $id);
        } elseif ($type == 'company') {
            $query->where('register_number', $id);
        }
        $client = $query->first();


        if (!$client) {
            $query = ClientRequest::query()->with(['status' => fn($q) => $q->select(['id', 'name']), 'branch' => fn($q) => $q->select(['id', 'name'])]);
            if ($type == 'individual') {
                $query->where('card_id', $id);
            } elseif ($type == 'company') {
                $query->where('register_number', $id);
            }
            $clientRequest = $query->latest()->first();

            if (!$clientRequest) {
                $message = $this->getMessageError("id");
                return $this->errorResponse(['message' => $message, 'id' => $id]);
            } elseif ($clientRequest->status?->name == 'pending') {
                $message = $this->getMessageError("pending");
                return $this->pendingResponse($message);
            } elseif ($clientRequest->status?->name == 'denied') {
                if ($clientRequest->type == 'company') {
                    $data = new ClientCompanyResource($clientRequest);
                } else {
                    $data = new ClientIdvividualResource($clientRequest);
                }
                return $this->deniedResponse(['message' => $clientRequest->note, 'client' => $data]);
            } else {
                $message = $this->getMessageError("id");
                return $this->errorResponse(['message' => $message, 'id' => $id]);
            }
        } else {
            if ($client->id < 3) {
                $code = "111111";
            } else {
                $code = rand(100000, 999999);
            }
            $client->otp = $code;
            $client->otp_expire = Carbon::now()->addMinutes(15);
            $client->save();
            $status = null;
            if ($client->id > 2) {
              $status = sendOtpSms($client->phone, $code);
            }

            $message = __('message.sms-sent');
            $phone = substr($client->phone, -3);
            $data = ['message' => $message, 'phone' => $phone, 'id' => $id];
            return $this->successResponse($data, $message,);
        }
    }


    public function confirm(Request $request)
    {
        $rules = [
            'id' => 'required|numeric', //length
            'otp' => 'required|numeric',
            'imei' => 'required|string',
            'token' => 'required|string',
            'device_type' => 'required|string|in:android,ios',
            'type' => 'required|in:individual,company',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $input = $request->all();
        foreach ($input as $key => $value) {
            $$key = stripslashes(trim(filter_var($value, FILTER_SANITIZE_STRING)));
        }
        $id = $input['id'];
        $query = Client::where('otp', $input['otp'])->where('otp_expire', '>=', now());
        if ($input['type'] === 'individual') {
            $query->where('card_id', $id);
        } elseif ($input['type'] === 'company') {
            $query->where('register_number', $id);
        }
        $client = $query->first();

        if ($client) {
//            Auth::guard('api-client')->login($client);
            $client->otp = null;
            $client->otp_expire = now();
            $client->save();

           $device = Device::updateDevice($client->id, 'clients', $input['imei'], $input['token'], $input['device_type']);

            //  test notification

            $fcm = new FCMService();
            $fcm->sendNotification([$device->token], "Hello " . $client->name, "Thank you for verify Account", "other", "other", null, null, "Client");

            // end test

            $token = $client->createToken('client', ['client']);
            if ($client->type == 'company') {
                $clientData = new ClientCompanyResource($client);
            } else {
                $clientData = new ClientIdvividualResource($client);
            }
            $data = ['client' => $clientData, 'token' => $token->accessToken];
            return $this->successResponse($data);
        } else {
            $message = $this->getMessageError("wrong-otp");
            return $this->errorResponse($message);
        }

//        if (Auth::guard('client')->attempt($credentials)) {
//            $client = Auth::user();
//
////            $device_count  = Device::where('user_id', $user->id)->where('imei','<>', $imei)->count();
////            if($device_count > 0 && $user->id > 1){
////                $message = $this->getMessageError("device");
////                return $this->errorResponse($message);
////            }
//
//            Device::updateDevice($client->id,'Client', $imei, $token, $device_type);
//            $token = $client->createToken('auth_token')->plainTextToken;
//            $data = ['access_token' => $token,'token_type' => 'Bearer','client'=>$client];
//            return $this->successResponse($data);
//        }
    }

    public function register(Request $request)
    {
        $rules = [
            'type' => 'required|in:individual,company',
            'name' => 'required_if:type,individual|string',
            'card_id' => 'required_if:type,individual|unique:clients,card_id',
            'card_image' => 'nullable|image',
            'register_number' => 'nullable|required_if:type,company|unique:clients,register_number',
            'agent_name' => 'nullable|required_if:type,company|string',
            'register_image' => 'nullable|image',
            'phone' => 'required|numeric',
            'email' => 'nullable|email',
            'branch_id' => 'nullable|exists:branches,id',
            'letter_head' => 'required|string',
        ];
//        $type = $request->get('type');

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }
        $input = $request->all();

        $input['confirmed'] = false;
//        return $this->errorResponse($input);
        $query =  ClientRequest::query();
        if ($input['type'] == 'company') {
            $input['card_id'] = null;
            $input['card_image'] = null;
            $query->where('register_number', $request->get('register_number'));
        } else {
            $input['register_number'] = null;
            $input['agent_name'] = null;
            $input['register_image'] = null;
            $query->where('card_id', $request->get('card_id'));
        }
        $input['from'] = 'mobile';
        $input['status_id'] = Status::where('type', 'requests')->where('name', 'pending')->value('id') ;
        $requestsCount = $query->count();
//        return $requestsCount ;
        $setting = Setting::where('type','dashboard')->where('key','requests_limit')->value('value') ?? 3;
        if ($requestsCount > $setting){
            $message = $this->getMessageError("requests-limit");
            return $this->errorResponse($message);
        }

        $clientRequest = ClientRequest::create($input);
        if ($clientRequest) {
            if ($input['type'] == 'company' && !empty($input['register_image'])) {
                $input['register_image'] = uploadFile($input['register_image'], "clients-requests", $clientRequest->id, 'register_image');
                $clientRequest->update(['register_image' => $input['register_image']]);
            } elseif ($input['type'] == 'individual' && !empty($input['card_image'])) {
                $input['card_image'] = uploadFile($input['card_image'], "clients-requests", $clientRequest->id, 'card_image');
                $clientRequest->update($input);
            }
            return $this->successResponse(true, __('message.request-sent'));
        } else {
            $message = $this->getMessageError("something went wrong");
            return $this->errorResponse($message);
        }
    }

    public function branches(Request $request)
    {
//        $rules = [
//            'id' => 'required|numeric', //length
//            'imei' => 'required|string',
//            'token' => 'required|string',
//            'device_type' => 'required|string|in:android,ios',
//        ];
//
//        $validator = validator()->make($request->all(), $rules);
//        if ($validator->fails()) {
//            return $this->validationErrorResponse($validator->errors());
//        }
//        $input = $request->all();
//
//        if(!Device::where('imei',$input['imei'])->exist()){
//            return $this->errorResponse('دا عندها');
//        }

        $data = Branch::get(['id', 'name','latitude','longitude','address']);
        return $this->successResponse($data);
    }

    public function logout(Request $request)
    {
        // $request->user()->token()->revoke();

        $user = auth('api-client')->user();
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
