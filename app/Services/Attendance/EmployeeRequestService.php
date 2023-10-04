<?php
namespace App\Services\Attendance;
use App\Models\Client;
use App\Models\ClientRequest;
use App\Models\Employee\EmployeeRequest;
use App\Models\Hr\Branch;
use App\Services\MainService;
use App\Traits\AdminTrait;
use Exception;

class EmployeeRequestService extends MainService {

    public function fetchAll() {
        return EmployeeRequest::get();
    }


    public function search($search)
    {
        return empty($search) ? EmployeeRequest::query()
            : EmployeeRequest::query()->where('name', 'like', '%' . $search . '%')
                ->orWhere('responsible', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhereHas('employee', fn($q) => $q->where('name','like', '%'.$search.'%'));
    }


    public function store(array $data) {
        try{
            $employeeRequest = EmployeeRequest::create($data);
            return $employeeRequest;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($employeeRequest, array $data) {
        try {
            $employeeRequest->update($data);
            return $employeeRequest;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($employeeRequest) {
        // check if branch have managaments
        if($employeeRequest->employee_id > 0) {
            return 0;
        } else {
            $employeeRequest->delete();
        }
    }
}
