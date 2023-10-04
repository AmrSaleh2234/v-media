<?php

namespace App\Http\Livewire\Employee\Attendance;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Attendance;
use App\Models\Employee\Employee;
use App\Models\Hr\Branch;
use App\Models\Hr\Management;
use App\Models\Hr\Department;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Table extends BasicTable
{

    public $branches = [];
    public $managements = [];
    public $departments = [];
    public $employees = [];
    public  $emps = [];

    public $timezone = "Africa/Cairo";

    public $branchId, $managementId, $departmentId, $employeeId, $fromDate, $toDate;
    public $ids = [], $empId;

    public function mount(Request $request)
    {
        $this->branches = Branch::pluck('name', 'id')->toArray();
        // $this->attendances = Attendance::whereDate('created_at', now())->get();
        $this->fromDate = date("Y-m-d");
        $this->toDate = date("Y-m-d");
        $this->searchEmployees();
        $timezone = timezone($request->ip());
        if ($timezone != "") {
            $this->timezone = $timezone;
        }


    }

    public function render()
    {
        $employeesGroups = $this->searchEmployees();
        return view('livewire.employee.attendance.table',compact('employeesGroups'));
    }


    public function updatedBranchId($data)
    {
        $this->managements = Management::where('branch_id', $data)->pluck('name', 'id')->toArray();
//        $this->searchEmployees();
    }

    public function updatedManagementId($data)
    {
        $this->departments = Department::where('management_id', $data)->pluck('name', 'id')->toArray();
//        $this->searchEmployees();
    }

    public function updatedDepartmentId($data)
    {
//        $this->searchEmployees();
    }

    public function updatedEmployeeId($data)
    {
        $this->empId = $data;
    }

    public function searchEmployees()
    {
        $employees = Employee::query()->draft(0);
        if ($this->employeeId) {
            $employees->where('id', $this->employeeId);
        }else{
            if (!empty($this->departmentId)) {
                $employees->whereHas("workAt", fn($q) => $q->where('workable_id', $this->departmentId)->where('workable_type', 'departments'));
            } elseif (!empty($this->managementId)) {
                $employees->whereHas("workAt", fn($q) => $q->where('workable_id', $this->managementId)->where('workable_type', 'managements'));
                $departmentIds = Department::where('management_id',$this->managementId)->pluck('id')->toArray();
                $employees->orWhereHas("workAt", fn($q) => $q->whereIn('workable_id', $departmentIds)->where('workable_type', 'departments'));
            } elseif (!empty($this->branchId)) {
                $employees->whereHas("workAt", fn($q) => $q->where('workable_id', $this->branchId)->where('workable_type', 'branches'));
                $managementIds = Management::where('branch_id',$this->branchId)->pluck('id')->toArray();
                $employees->orWhereHas("workAt", fn($q) => $q->whereIn('workable_id', $managementIds)->where('workable_type', 'managements'));
                $departmentIds = Department::whereIn('management_id',$managementIds)->pluck('id')->toArray();
                $employees->orWhereHas("workAt", fn($q) => $q->whereIn('workable_id', $departmentIds)->where('workable_type', 'departments'));
            }
        }
        $this->emps = $employees->latest()->get() ;
        $ranges = CarbonPeriod::create($this->fromDate, $this->toDate);
        $list = collect();
        foreach ($ranges as $rangeDate){
            $employees->with(['attendances'=>fn($q) => $q->whereDate('created_at',
            $rangeDate->format('Y-m-d'))
                ,'shift'=>fn($q)=>$q->whereHas('days',fn($q)=>$q->where('day_name',$rangeDate->format('D'))),'workAt']);
            $list[$rangeDate->format('Y-m-d')] = $employees->latest()->get();
        }

        return $list;
    }

    public function tsearchEmployees()
    {
        $employees = Employee::query()->draft(0);

        if ($this->employeeId) {
            $employees->where('id', $this->employeeId);
        }else{
            if (!empty($this->departmentId)) {
                $employees->whereHas("workAt", fn($q) => $q->where('workable_id', $this->departmentId)->where('workable_type', 'departments'));
            } elseif (!empty($this->managementId)) {
                $employees->whereHas("workAt", fn($q) => $q->where('workable_id', $this->managementId)->where('workable_type', 'managements'));
                $departmentIds = Department::where('management_id',$this->managementId)->pluck('id')->toArray();
                $employees->orWhereHas("workAt", fn($q) => $q->whereIn('workable_id', $departmentIds)->where('workable_type', 'departments'));
            } elseif (!empty($this->branchId)) {
                $employees->whereHas("workAt", fn($q) => $q->where('workable_id', $this->branchId)->where('workable_type', 'branches'));
                $managementIds = Management::where('branch_id',$this->branchId)->pluck('id')->toArray();
                $employees->orWhereHas("workAt", fn($q) => $q->whereIn('workable_id', $managementIds)->where('workable_type', 'managements'));
                $departmentIds = Department::whereIn('management_id',$managementIds)->pluck('id')->toArray();
                $employees->orWhereHas("workAt", fn($q) => $q->whereIn('workable_id', $departmentIds)->where('workable_type', 'departments'));
            }
        }
        $this->emps = $employees->latest()->get() ;
        $ranges = CarbonPeriod::create($this->fromDate, $this->toDate);

        $employees->with(['attendances'=>fn($q) => $q->where(function ($q) use ($ranges) {
            foreach ($ranges as $rangeDate) {
                $q->orWhereDate('created_at', $rangeDate->format('Y-m-d'));
            }
        })
            ,'shift'=>fn($q)=>$q->whereHas('days',fn($q)=>$q->where('day_name', Carbon::now()->format('D'))),'workAt']);

        return $employees->latest()->get();
    }


//    public function delete($id)
//    {
//        Attendance::findOrFail($id)->delete();
//        $this->dispatchBrowserEvent('toastr',
//            ['type' => 'success', 'message' => __('message.deleted', ['model' => __('names.attend-in')])]);
//    }

}
