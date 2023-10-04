<?php
namespace App\Services\CMS;
use App\Models\CMS\CompanyProject;
use App\Services\MainService;
use Exception;

class CompanyProjectService extends MainService {

    public function fetchAll() {
        return CompanyProject::get();
    }

//    public function fetchWithCounts() {
//
//        return Service::withCount('managements','departments','belongers')->get();
//    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return CompanyProject::where('id',$id)->pluck('name','id')->toArray();
        }
        return CompanyProject::pluck('name','id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? CompanyProject::query()
            : CompanyProject::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');

    }

    public function store(array $data) {
        try{
            $project = CompanyProject::create($data);
            return $project;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($project, array $data) {
        try {
            $project->update($data);
            return $project;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($project) {
        if($project->active) {
            return 0;
        } else {
            $project->delete();
        }
    }
}
