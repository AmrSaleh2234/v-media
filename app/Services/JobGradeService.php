<?php
namespace App\Services;

use App\Models\Hr\JobGrade;
use Exception;

class JobGradeService extends MainService {

    public function fetchAll() {
        return JobGrade::get();
    }

    public function search($search)
    {
        return empty($search) ? JobGrade::query()
            : JobGrade::query()->where('salary', 'like', '%' . $search . '%')
                ->orWhere('years', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhereHas('jobType', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

    public function store(array $data) {
        try{
            $JobGrade = JobGrade::create($data);
            return $JobGrade;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($JobGrade, array $data) {
        try {
            $JobGrade->update($data);
            return $JobGrade;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($JobGrade) {
        if($JobGrade->employees) {
            return 0;
        } else {
            $JobGrade->delete();
        }
    }
}
