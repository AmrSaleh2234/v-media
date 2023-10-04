<?php
namespace App\Services;
use App\Models\Hr\JobType;
use Exception;

class JobTypeService extends MainService{

    public function fetchAll() {
        return JobType::get();
    }

    public function search($search)
    {
        return empty($search) ? JobType::query()
            : JobType::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhereHas('jobNames', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

    public function store(array $data) {
        try{
            $JobType = JobType::create($data);
            return $JobType;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($JobType, array $data) {
        try {
            $JobType->update($data);
            return $JobType;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($JobType) {
        // check if branch have managaments
        if($JobType->jobNames) {
            return 0;
        } else {
            $JobType->delete();
        }
    }
}
