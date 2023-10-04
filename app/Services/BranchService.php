<?php
namespace App\Services;
use App\Models\Hr\Branch;
use App\Models\Hr\BranchPaper;
use Exception;

class BranchService extends MainService {

    public function fetchAll() {
        return Branch::get();
    }

    public function fetchWithCounts() {

        return Branch::withCount('managements','departments','workers');
    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return Branch::where('id',$id)->pluck('name','id')->toArray();
        }
        return Branch::pluck('name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? Branch::query()->where('type','central')
            : Branch::query()
                ->where('type','central')
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhereHas('manager', fn($q) => $q->where('name','like', '%'.$search.'%'));
//                ->orWhereHas('managements', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

    public function store(array $data) {
        try{
            $branch = Branch::create($data);
            return $branch;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }


      public function storeMeta(array $data) {
        try{
            $branch = BranchPaper::create($data);
            return $branch;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($branch, array $data) {
        try {
            $branch->update($data);
            return $branch;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($branch) {
        // check if branch have managaments
        if($branch->managments) {
            return 0;
        } else {
            $branch->delete();
        }
    }
}
