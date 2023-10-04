<?php

namespace App\Http\Livewire\Attendance\EmployeeRequests;

use App\Http\Livewire\Basic\Modal;
use App\Models\Attendance;
use App\Models\Employee\EmployeeRequest;
use App\Models\Hr\Shift;
use App\Models\Status;
use App\Models\User;
use App\Notifications\MainNotification;
use App\Services\FCM\FCMService;
use App\Traits\AttendanceTrait;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;

class EmployeeRequestsView extends Modal
{

    use AttendanceTrait;
    protected $rules = [
        'employeeRequest.status_id' => 'required|exists:statuses,id',
        'employeeRequest.response' => 'nullable|string'
    ];
    protected $listeners = [ 'updateLatAndLong' => 'updateLatAndLong'];
    public $employeeRequest;
    public $employeeRequest_id;
    public $statues;
    public $Oldresponse;
    public $deniedId ;
    public $timezone = "Africa/Cairo";
    public function mount(Request $request, $id) {
        $this->employeeRequest_id = $id;
        $this->employeeRequest = EmployeeRequest::with('status')->whereId($id)->first();
        $this->statues = Status::where("type",'employee-requests')->pluck('name', 'id')->toArray();
        $this->Oldresponse = $this->employeeRequest->response;
        foreach ($this->statues as $key => $name) {
            if ($name === 'pending') {
                $this->deniedId =  $key;
                break;
            }
        }

        $timezone = timezone($request->ip());
        if($timezone != "") {
            $this->timezone = $timezone;
        }
//        dd(    $this->employeeRequest->status);
//        dd($this->deniedId);
    }

    public function render()
    {
        return view('livewire.attendance.employee-requests.employee-requests-view');
    }


    public function updatedEmployeeRequestStatusId($data) {
        if($data == $this->deniedId) {
            $this->employeeRequest->response = "";
        }else{
            $this->employeeRequest->response =  $this->Oldresponse;
        }
    }

    public function updateLatAndLong($data) {
       $coo = explode('-',$data);
       $this->employeeRequest->latitude = $coo[0];
       $this->employeeRequest->longitude = $coo[1];
       $this->employeeRequest->save();
       $this->dispatchBrowserEvent('toastr',
       ['type' => 'success', 'message' => __('message.created',['model' => __('names.location')])]);

       //$this->dispatchBrowserEvent('initMap');
    }
    public function save(Request $request) {
        $validated = $this->validate();
        $this->employeeRequest->save();


        $this->dispatchBrowserEvent('toastr',
            ['type' => 'success',  'message' =>__('message.updated',['model'=>__('names.employee-request')])]);
//        $statusId = Status::where("type",'tickets')->where('name','accepted')->value('id');
        $this->employeeRequest = EmployeeRequest::whereId($this->employeeRequest_id)->first();


        // approve late // checkin ll user when request created

        $statusId = Status::where('type','employee-requests')->where('name','accepted')->value('id');
        $userTimeZone = timezone($request->ip());
        if($userTimeZone == "") {
            $userTimeZone = "Africa/Cairo";
        }
        if($this->employeeRequest->type == "late" && $this->employeeRequest->status_id == $statusId) {
            $attendance = Attendance::where('employee_id', $this->employeeRequest->employee_id)->whereDate('created_at',$this->employeeRequest->created_at)->first();
            $shift = $this->getEmpShift($this->employeeRequest->employee);
            if(! $shift instanceof Shift) {
                return $this->errorResponse('Error in shift or branch', 500);
            }
            if(empty($attendance)) {
                Attendance::create([
                   'employee_id' => $this->employeeRequest->employee_id,
                   'shift_id' => $shift->id,
                   'check_in' => Date('h:i A', strtotime($this->employeeRequest->created_at)),
                   'timezone' => $userTimeZone,
                ]);
            }
        } else if ($this->employeeRequest->type == "checkoutPermission" && $this->employeeRequest->status_id == $statusId) {
             $attendance = Attendance::where('employee_id',$this->employeeRequest->employee_id)->whereDate('created_at', Carbon::today())->first();
             if(!empty($attendance)) {
                $attendance->check_out = Date('h:i A');
                $attendance->save();
             }
        }



        $user = User::whereHas('employee',fn($q)=>$q->whereHas('requests',fn($q)=>$q->where('id',$this->employeeRequest_id)))->first();
        $data = [];
        $data['from'] =  config('app.name');
        $data['message'] = 'تم الرد علي طلبك ' . ",تم تغيير حالة طلبك إلي " .
           __('names.'. $this->employeeRequest->status?->name);
        $user->notify(new MainNotification($data));
        $this->close("changeStatus");
        $fcm = new FCMService();
       $fcm->sendNotification([$this->employeeRequest->employee?->user?->id],"تم الرد علي طلب " .
       $this->employeeRequest->name,$data['message']
        , null, null, null, "users");
    }

}
