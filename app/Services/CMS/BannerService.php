<?php
namespace App\Services\CMS;
use App\Models\CMS\Banner;
use App\Services\MainService;
use Exception;

class BannerService extends MainService {

    public function fetchAll() {
        return Banner::get();
    }

//    public function fetchWithCounts() {
//
//        return Service::withCount('managements','departments','belongers')->get();
//    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return Banner::where('id',$id)->pluck('name','id')->toArray();
        }
        return Banner::pluck('name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? Banner::query()
            : Banner::query()->where('name', 'like', '%' . $search . '%');
    }

    public function store(array $data) {
        try{
            $banner = Banner::create($data);
            return $banner;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($banner, array $data) {
        try {
            $banner->update($data);
            return $banner;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($banner) {
        if($banner->active) {
            return 0;
        } else {
            $banner->delete();
        }
    }
}
