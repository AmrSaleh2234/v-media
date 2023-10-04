<?php

namespace App\Http\Livewire\Attendance\EmployeeRequests;

use App\Http\Livewire\Basic\BasicTable;
use App\Models\Status;
use App\Services\Attendance\EmployeeRequestService;
use Illuminate\Http\Request;
use Livewire\Component;

class EmployeeRequestsTable extends BasicTable
{

    protected $listeners = ['confirmDelete'];
    public $userTimeZone = 'Africa/Cairo';
    public function mount(Request $request) {
        $this->userTimeZone = timezone($request->ip());
        if($this->userTimeZone == "") {
            $this->userTimeZone = "Africa/Cairo";
        }
    }
    public function render()
    {
        $service = new EmployeeRequestService();
        return view('livewire.attendance.employee-requests.employee-requests-table', [
            'employeeRequests' => $service->search($this->search)
                ->with('employee','status')
                ->when($this->start_date, function ($query) {
                    $query->where('created_at', '>=', $this->start_date);
                })
                ->when($this->end_date, function ($query) {
                    $query->where('created_at', '<=', $this->end_date);
                })
                ->when(!empty($this->status_id), function ($query) {
                    $query->where('status_id', '>=', $this->status_id);
                })
                ->orderBy($this->orderBy, $this->orderDesc ? 'desc' : 'asc')
                ->paginate($this->perPage),
            'statuses' => Status::where('type', 'employee-requests')->get(['id', 'name'])
        ]);
    }
}
