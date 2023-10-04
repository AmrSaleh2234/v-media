<?php
namespace App\Services\CMS;

use App\Models\CMS\Banner;
use App\Models\CMS\Subscriber;
use App\Services\MainService;
use Exception;

class SubscribeService extends MainService {

    public function fetchAll() {
        return Subscriber::get();
    }

//    public function fetchWithCounts() {
//
//        return Service::withCount('managements','departments','belongers')->get();
//    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return Subscriber::where('id',$id)->pluck('name','id')->toArray();
        }
        return Subscriber::pluck('name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? Subscriber::query()
            : Subscriber::query()->where('email', 'like', '%' . $search . '%');
    }

    public function store(array $data) {
        try{
            $subscriber = Subscriber::create($data);
            return $subscriber;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($subscriber, array $data) {
        try {
            $subscriber->update($data);
            return $subscriber;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($subscriber) {
        if($subscriber->active) {
            return 0;
        } else {
            $subscriber->delete();
        }
    }
}
