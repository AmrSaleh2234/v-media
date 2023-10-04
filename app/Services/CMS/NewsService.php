<?php
namespace App\Services\CMS;
use App\Models\CMS\News;
use App\Models\CMS\Service;
use App\Models\Hr\Branch;
use App\Services\MainService;
use Exception;

class NewsService extends MainService {

    public function fetchAll() {
        return News::get();
    }

//    public function fetchWithCounts() {
//
//        return Service::withCount('managements','departments','belongers')->get();
//    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return News::where('id',$id)->pluck('name','id')->toArray();
        }
        return News::pluck('name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? News::query()
            : News::query()->where('title', 'like', '%' . $search . '%')
        ->orWhere('content', 'like', '%' . $search . '%');
    }

    public function store(array $data) {
        try{
            $news = Service::create($data);
            return $news;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($news, array $data) {
        try {
            $news->update($data);
            return $news;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($news) {
        if($news->active) {
            return 0;
        } else {
            $news->delete();
        }
    }
}
