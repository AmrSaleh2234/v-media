<?php
namespace App\Services;
use App\Models\Hr\Branch;
use App\Models\Hr\BranchPaper;
use App\Models\Hr\University;
use Exception;

class UniversityService extends MainService {

    public function fetchAll() {
        return University::get();
    }

    public function fetchWithCounts() {

        return University::get();
    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return University::where('id',$id)->pluck('name','id')->toArray();
        }
        return University::pluck('name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? University::query()
            : University::query()
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('name_ar', 'like', '%' . $search . '%');
//                ->orWhereHas('managements', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

    public function store(array $data) {
        try{
            $university = University::create($data);
            return $university;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }


    public function update($university, array $data) {
        try {
            $university->update($data);
            return $university;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($university) {
        // check if branch have managaments
        if($university->active) {
            return 0;
        } else {
            $university->delete();
        }
    }
}
