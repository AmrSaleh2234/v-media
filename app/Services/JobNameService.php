<?php
namespace App\Services;
use App\Models\Hr\JobName;
use Exception;

class JobNameService extends MainService {

    public function fetchAll() {
        return JobName::get();
    }

    public function search($search)
    {
        return empty($search) ? JobName::query()
            : JobName::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhereHas('jobType', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

    public function store(array $data) {
        try{
            $JobName = JobName::create($data);
            return $JobName;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($JobName, array $data) {
        try {
            $JobName->update($data);
            return $JobName;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($JobName) {
        if($JobName->employees) {
            return 0;
        } else {
            $JobName->delete();
        }
    }
}
