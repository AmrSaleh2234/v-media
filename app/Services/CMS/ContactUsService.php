<?php
namespace App\Services\CMS;

use App\Models\CMS\Banner;
use App\Models\CMS\ContactUs;
use App\Models\CMS\Subscriber;
use App\Services\MainService;
use Exception;

class ContactUsService extends MainService {

    public function fetchAll() {
        return ContactUs::get();
    }

//    public function fetchWithCounts() {
//
//        return Service::withCount('managements','departments','belongers')->get();
//    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return ContactUs::where('id',$id)->pluck('name','id')->toArray();
        }
        return ContactUs::pluck('name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? ContactUs::query()
            : ContactUs::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
    }

    public function store(array $data) {
        try{
            $contactUs = ContactUs::create($data);
            return $contactUs;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($contactUs, array $data) {
        try {
            $contactUs->update($data);
            return $contactUs;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($contactUs) {
        if($contactUs->active) {
            return 0;
        } else {
            $contactUs->delete();
        }
    }
}
