<?php
namespace App\Services\CMS;
use App\Models\CMS\Banner;
use App\Models\CMS\Category;
use App\Services\MainService;
use Exception;

class CategoryService extends MainService {

    public function fetchAll() {
        return Category::get();
    }

//    public function fetchWithCounts() {
//
//        return Service::withCount('managements','departments','belongers')->get();
//    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return Category::where('id',$id)->pluck('name','id')->toArray();
        }
        return Category::pluck('name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? Category::query()
            : Category::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%');
    }

    public function store(array $data) {
        try{
            $category = Category::create($data);
            return $category;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($category, array $data) {
        try {
            $category->update($data);
            return $category;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($category) {
        if($category->active) {
            return 0;
        } else {
            $category->delete();
        }
    }
}
