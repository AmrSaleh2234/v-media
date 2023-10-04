<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\ApiController;

use App\Http\Resources\AttachmentResource;
use App\Http\Resources\CMS\CompanyProjectResource;
use App\Http\Resources\CMS\IconResource;
use App\Http\Resources\CMS\MemberResource;
use App\Http\Resources\CMS\ServiceResource;
use App\Http\Resources\SettingResource;
use App\Models\Attachment;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\ContactUs;
use App\Models\CMS\Icon;
use App\Models\CMS\Member;
use App\Models\CMS\Service;
use App\Models\CMS\ServiceRequest;
use App\Models\CMS\Subscriber;
use App\Models\Setting;
use App\Services\CMS\ServiceService;
use Illuminate\Http\Request;

class SettingController extends ApiController
{

    public function __construct(ServiceService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function setting()
    {
//        $settings = Setting::where('type','website')->pluck('value','key')->toArray();
//        return  response()->json(SettingResource::collection($settings));
        $settings = Setting::where('type','website')->where('group','setting')->get();
      return  $this->successResponse(SettingResource::collection($settings));
    }
    public function getSetting(Request $request)
    {
        $rules = ['key' => 'required|string|exists:settings,key'];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $setting = Setting::where('type','website')->where('key',$request->get('key'))->get(['key','value']);
        return  $this->successResponse(new SettingResource($setting));
    }

    public function mainPage(Request $request)
    {
        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';
        $setting = Setting::where('group','setting')->whereIn('key',['main_page_icon','main_description'])->pluck('value','key')->toArray();
//        return $setting[''];
        $icons = IconResource::collection(Icon::website()->when(!empty($setting),function ($q) use ($setting){
            $q->where('type',$setting);
        })->get());
        $services = ServiceResource::collection(Service::website()->isFeatured()->get());
        $projects = CompanyProjectResource::collection(CompanyProject::website()->isFeatured()->get());
        $members = MemberResource::collection(Member::website()->get());
        $organizationChart =  Setting::where('key','organization_chart')->value('value') ?? [];
        $file = !empty($organizationChart[0]) ? asset('storage/'.$organizationChart[0]) : null;

        return  $this->successResponse(['icons'=>['icons'=>$icons,'type'=>__('names.'.$setting['main_page_icon']) ] ,'main_description'=>$setting['main_description'][$lang],'services'=>$services,'projects'=>$projects,'members'=>$members,'file'=>$file]);
    }

    public function aboutPage(Request $request)
    {
        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';

        $settings = Setting::where('group','about_us')->get(['key','value']);
//        return $settings ;
        foreach ( $settings as $k => $setting ){
            if ($setting['key'] == 'about_page_icons'){
                $type = $setting['value'] ;
                unset( $settings[$k]);
            }elseif ($setting['key'] == 'projects'){
               $projects = [];
               foreach ($setting['value'] as $key => $project){
                   $projects[] = ['name'=>$project[$lang],'num'=>$project['num']];
               }
               unset( $settings[$k]);
            }
        }

        $icons = IconResource::collection(Icon::website()->when(!empty($type),function ($q) use ($type){
            $q->where('type',$type);
        })->get());
        $partners = IconResource::collection(Icon::website()->where('type','partners')->get());
//        return $settings ;
        foreach ( $settings as $setting){
            if ($setting->key == 'files'){
                $files = $setting->value ;
            }
        }
        $files = AttachmentResource::collection(Attachment::where('type','about-files')->whereIn('path',$files)->get()) ;

        $lang = $request->header('lang') == 'en' ? 'en' : 'ar' ;

        return $this->successResponse(['icons'=>['icons'=>$icons,'type'=> $lang == "ar" ? __('names.'.$type) : $type]
        ,'projects' =>
        $projects,'partners'=>$partners,'settings' => SettingResource::collection($settings),'files'=>$files]);
    }

    public function subscribe(Request $request)
    {

        $rules = [
            'email' => 'required|email|unique:subscribers,email',
//            'channel' => 'nullable|string',
//            'from' => 'nullable|string',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $input = $request->only(['email']);
        $input['channel'] = 'the-news';
        $input['from'] = 'website';
        Subscriber::create($input);
        return  $this->successResponse('Subscribed Successfully');
    }

    public function contact(Request $request){
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'nullable|email',
            'title' => 'required|string',
            'content' => 'required|string',
            'from' => 'nullable|string',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $input = $request->only(['first_name','last_name','phone','email','title','content','from']);
        $input['from'] = 'website';
        ContactUs::create($input);
        return  $this->successResponse('Received Successfully');
    }

    public function requestService(Request $request){
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'service_id' => 'required|exists:services,id',
            'from' => 'nullable|string',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $input = $request->only(['first_name','last_name','phone','email','service_id','from']);
        $input['from'] = 'website';
        ServiceRequest::create($input);
        return  $this->successResponse('Service Request Received Successfully');
    }

}
