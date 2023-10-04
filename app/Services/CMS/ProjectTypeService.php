<?php
namespace App\Services\CMS;
use App\Models\CMS\CompanyProject;
use App\Models\CMS\ProjectType;
use App\Services\MainService;
use Exception;

class ProjectTypeService extends MainService {

    public function fetchAll() {
        return ProjectType::get();
    }

//    public function fetchWithCounts() {
//
//        return Service::withCount('managements','departments','belongers')->get();
//    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return ProjectType::where('id',$id)->pluck('name','id')->toArray();
        }
        return ProjectType::pluck('name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? ProjectType::query()
            : ProjectType::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('group', 'like', '%' . $search . '%');

    }

    public function store(array $data) {
        try{
            $projectType = ProjectType::create($data);
            return $projectType;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($projectType, array $data) {
        try {
            $projectType->update($data);
            return $projectType;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($projectType) {
        if($projectType->projects()->exists()) {
            return 0;
        } else {
            $projectType->delete();
        }
    }
}
