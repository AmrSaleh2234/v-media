<?php
namespace App\Services\GADA;
use App\Models\GADA\Agreement;
use App\Models\Hr\Branch;
use App\Models\Hr\BranchPaper;
use App\Services\MainService;
use Exception;

class AgreementService extends MainService {

    public function fetchAll() {
        return Agreement::get();
    }

    public function fetchWithCounts() {

        return Agreement::get();
    }

    public function fetchAsArray($id = null) {
        if($id != null) {
            return Agreement::where('id',$id)->pluck('content','id')->toArray();
        }
        return Agreement::pluck('content','id')->toArray();
    }

    public function search($search)
    {
        return empty($search) ? Agreement::query()
            : Agreement::query()
                ->where('content','central');
//                ->orWhereHas('managements', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }

    public function store(array $data) {
        try{
            $agreement = Agreement::create($data);
            return $agreement;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($agreement, array $data) {
        try {
            $agreement->update($data);
            return $agreement;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($agreement) {
        if($agreement->active) {
            return 0;
        } else {
            $agreement->delete();
        }
    }
}
