<?php
namespace App\Services\CMS;

use App\Models\CMS\Banner;
use App\Models\CMS\ContactUs;
use App\Models\CMS\ServiceRequest;
use App\Models\CMS\Subscriber;
use App\Services\MainService;
use Exception;

class ServiceRequestService extends MainService {

    public function fetchAll() {
        return ServiceRequest::get();
    }

//    public function fetchWithCounts() {
//
//        return Service::withCount('managements','departments','belongers')->get();
//    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return ServiceRequest::where('id',$id)->pluck('first_name','id')->toArray();
        }
        return ServiceRequest::pluck('first_name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? ServiceRequest::query()
            : ServiceRequest::query()->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%');
    }

    public function store(array $data) {
        try{
            $serviceRequest = ServiceRequest::create($data);
            return $serviceRequest;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($serviceRequest, array $data) {
        try {
            $serviceRequest->update($data);
            return $serviceRequest;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($serviceRequest) {
        if($serviceRequest->active) {
            return 0;
        } else {
            $serviceRequest->delete();
        }
    }
}
