<?php

namespace App\Services\CMS;

use App\Models\CMS\Member;
use App\Models\CMS\Service;
use App\Models\Hr\Branch;
use App\Services\MainService;
use Exception;

class MemberService extends MainService
{

    public function fetchAll()
    {
        return Member::get();
    }

//    public function fetchWithCounts() {
//
//        return Service::withCount('managements','departments','belongers')->get();
//    }

    public function fetchAsArray($id = null)
    {
        if ($id != null) {
            return Member::where('id', $id)->pluck('name', 'id')->toArray();
        }
        return Member::pluck('name', 'id')->toArray();
    }


//    protected $fillable = [
//        'user_id', 'name', 'content', 'image', 'icon','attachment', 'active','phone','manger_name',
//        'address', 'order_id', 'latitude', 'longitude','polygon','email','type','country_id','state_id','city_id',
//        'parent_id', 'manger_id','shift_id', 'is_clients', 'is_mangers','is_services','is_papers','is_projects','is_shifts',
//        'share_client','share_service','share_paper','share_shift','share_manger'
//    ];
    public function search($search)
    {
        return empty($search) ? Member::query()
            : Member::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('job_title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');


    }

    public function store(array $data)
    {
        try {
            $member = Member::create($data);
            return $member;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($member, array $data)
    {
        try {
            $member->update($data);
            return $member;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($member)
    {
        if ($member->active) {
            return 0;
        } else {
            $member->delete();
        }
    }
}
