<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Api\ApiController;
use App\Models\Attendance;
use App\Models\Employee\Employee;
use App\Models\Employee\Offline;
use Illuminate\Http\Request;
use App\Models\Hr\ShiftDay;
use App\Models\Hr\Shift;
use App\Models\Employee\EmployeeRequest;
use App\Traits\AttendanceTrait;
use Carbon\Carbon;
use App\Models\Status;

use App\Http\Resources\AttendanceResource;

class AttendanceController extends ApiController
{

    use AttendanceTrait;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:api');
    }

    public function getAttendanceInfo(Request $request)
    {

        $employee = Employee::where([
            'user_id' => auth('api')->id(),
            'draft' => 0
        ])
            ->select("id", "user_id", "shift_id")
            ->with(["workAt" => function ($query) {
                $query->select('id', 'employee_id', 'workable_type', 'workable_id');
            }])
            ->with(["shift" => function ($query) {
                $query->select('id', "distance");
            }])
            ->first();


        if ($employee == null) {
            return $this->errorResponse('Employee Not Found', 404);
        }

        $attendance = Attendance::where('employee_id', $employee->id)->whereDate('created_at', Carbon::today())->first();
        if ($attendance) {
            $employee->attendances = $attendance;
        } else {
            $employee->attendances = null;
        }


        $branch = $this->getEmpBranch($employee);
        $shift = $this->getEmpShift($employee);

        // check in validate
        $userTimeZone = timezone($request->ip());
        if ($userTimeZone == "") {
            $userTimeZone = "Africa/Cairo";
        }

        if (!$shift instanceof Shift) {
            return $this->errorResponse("Error In Shift", 500);
        }
        $today = ShiftDay::where(['shift_id' => $shift->id, 'day_name' => Date("D")])
            ->select('shift_id', 'day_name', 'start_in', 'end_in', 'early_start_in', 'late_start_in')
            ->first();
        if (empty($today)) {
            return $this->errorResponse('No Work Today', 500);
        }
        if($request->hasHeader('timerOut')&&$request->header('timerOut'))//timer out is in front call offline
        {
            if($employee->attendances && $employee->attendances?->offline!=null)
            {
                $employee->attendances->check_out = now()->format('h:i A');
                $employee->attendances->save();

                $employee->attendances?->offline->delete();
            }


        }
        $statusId = Status::where('type', 'employee-requests')->where('name', 'accepted')->value('id');
        $request = EmployeeRequest::where([
            'employee_id' => $employee->id,
            'status_id' => $statusId,
        ])->where(function ($query) {
            $query->whereDate('time_from', '<=', Carbon::today());
            $query->whereDate('time_to', '>=', Carbon::today());
        })->select('employee_id', 'type', 'name', 'latitude', 'longitude', 'time_from', 'time_to', 'address', 'status_id')->latest()->first();


        $overtimeRequest = EmployeeRequest::where([
            'employee_id' => $employee->id,
            'type' => 'overtime',
        ])->whereDate('created_at', Carbon::today())->select('created_at', 'employee_id', 'type', 'name', 'latitude', 'longitude', 'time_from', 'time_to', 'address', 'status_id')->latest()->first();

        $request_type = "normal";
        $emp_request = null;
        $long = $branch->longitude;
        $lat = $branch->latitude;


        if ($request) {
            if ($request->type == "mission") {
                $request_type = "mission";
                $emp_request = $request;
                $long = $request->longitude;
                $lat = $request->latitude;
            } else if ($request->type == "remote") {
                // start of normal case
                $request_type = "remote";
                $emp_request = $request;
                $long = null;
                $lat = null;
            } else if ($request->type == "checkoutPermission") {
                $request_type = "checkoutPermission";
                $emp_request = $request;
            } else if ($request->type == "late") {
                $request_type = "late";
                $emp_request = $request;
            } else if ($request->type == "overtime") {
                $request_type = "overtime";
                $emp_request = $request;
            } else {
                return $this->errorResponse('unkown request type', 500);
            }


        }

        if (!empty($overtimeRequest)) {
            $request_type = "overtime";
            $emp_request = $overtimeRequest;
        }

        $data = [
            "request_type" => $request_type,
            "request" => $emp_request,
            "long" => $long,
            "lat" => $lat,
            "distance" => $shift->distance,
            "start_in" => Carbon::parse($today->start_in)->format('h:i A'),
            "start_before_until" => Carbon::parse($today->early_start_in)->format('h:i A'),
            "start_after_until" => Carbon::parse($today->late_start_in)->format('h:i A'),
            "end_in" => Carbon::parse($today->end_in)->format('h:i A'),
            "end_before_until" => Carbon::parse($today->end_in)->format('h:i A'),
            "end_after_until" => $this->getEndAfter(Carbon::parse($today->end_in)->format('h:i A')),
            "check_in" => empty($employee->attendances) ? false : true,
            "check_at" => !empty($employee->attendances?->check_in) ? Carbon::parse($employee->attendances?->check_in)->timezone($userTimeZone)->format('h:i A') : null,
            "check_out" => empty($employee->attendances?->check_out) ? false : true,
            "check_out_at" => !empty($employee->attendances?->check_out) ? Carbon::parse($employee->attendances?->check_out)->timezone($userTimeZone)->format('h:i A') : null,
            "work_hours" => abs((strtotime($today->end_in) - strtotime($today->start_in)) / 3600),
            "difference_work_hours" => !empty($employee->attendances?->check_out) ? abs((strtotime($employee->attendances?->check_out) - strtotime($employee->attendances?->check_in)) / 3600) : 0,
            "difference_offline_minutes" =>   $employee->attendances?->offline != null?
                explode(':',Carbon::parse($employee->attendances?->offline->time)
                    ->addMinutes($employee->attendances?->shift->offline
                    )
                    ->diff(Carbon::now()
                    )->format("%I:%S"))[0]  : 0 ,

            "difference_offline_seconds" =>  $employee->attendances?->offline != null?
                explode(':',Carbon::parse($employee->attendances?->offline->time)
                    ->addMinutes($employee->attendances?->shift->offline
                    )
                    ->diff(Carbon::now()
                    )->format("%I:%S"))[1]:0,



        ];

        return $this->successResponse($data);
    }

    public function storeAttendance(Request $request)
    {
        // Check request paramteres
        $rules = [
            "check_in" => "required",
            "check_out" => "required",
        ];
        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }
        //end Check request paramteres

        // check employee, branch and shift
        $employee = Employee::where([
            'user_id' => auth('api')->user()->id,
            'draft' => 0
        ])->with(["attendances" => function ($query) {
            $query->whereDay('created_at', now()->day)->first();
        }])->first();

        if ($employee == null) {
            return $this->errorResponse('Employee Not Found', 404);
        }

    // $empAttendances count($employee->attendances)
//        if ( < 2 ) {
//            return $this->errorResponse('Can Not Check In Again', 404);
//        }

        $branch = $this->getEmpBranch($employee);
        $shift = $this->getEmpShift($employee);
        if (!$shift instanceof Shift) {
            return $this->errorResponse('Error in shift or branch', 500);
        }
        // end check employee, branch and shift

        // get user time zone
        $userTimeZone = timezone($request->ip());
        if ($userTimeZone == "") {
            $userTimeZone = "Africa/Cairo";
        }
        // end timezone

        // get today and check if employee has work today
        $day = Carbon::now($userTimeZone)->format('D');
        $today = ShiftDay::where(["shift_id" => $shift->id, "day_name" => $day])->first();
        if (empty($today)) {
            return $this->errorResponse('No Work Today', 500);
        }
        // end check today


        // get employee today attendance
        $attendance = Attendance::where('employee_id', $employee->id)->whereDay('created_at', Carbon::today())->first();


        // check if request has check in
        if ($request->has('check_in') && $request->check_in == 1) {

            // get time now [ Original Date in UTC timezone which stored in db || dateNow in user time zone to check times in same timezone ]
            $originalDate = Date('h:i A');
            $dateNow = Carbon::parse($originalDate)->timezone($userTimeZone)->format('h:i A');


            // if employee has an request [ type => "remotly" || type => "Out of Zone" ]


            // End Check request

            // normal attendance which mean employee not has a request and must check in branch location


            //from settings get first available time could employee check in
            $canCheckInFrom = Carbon::parse($today->early_start_in)->format('h:i A');

            //from settings get last available time could employee check in
            $canCheckInTo = Carbon::parse($today->late_start_in)->format('h:i A');

            $canCheckOutFrom = Carbon::parse($today->end_in)->format('h:i A');

            //check if time now before first time and last time
            if (strtotime($dateNow) < strtotime($canCheckInFrom)) {

                return $this->errorResponse('You can not Check In Now', 500);
            }

            if (strtotime($dateNow) > strtotime($canCheckInTo) && strtotime($dateNow) < strtotime($canCheckOutFrom) && empty($attendance)) {
                return $this->errorResponse('Please Create Late Permission', 500);
            }

            if (strtotime($dateNow) > strtotime($canCheckInTo) && strtotime($dateNow) > strtotime($canCheckOutFrom) && !empty($attendance)) {
                return $this->errorResponse('Please Create Overtime Permission Permission', 500);
            }

            if (strtotime($dateNow) < strtotime($canCheckInTo)) {
                // check if employee already make attendance
                if (empty($attendance)) {
                    $attendance = new Attendance([
                        'employee_id' => $employee->id,
                        'shift_id' => $shift->id,
                        'check_in' => $originalDate,
                        'timezone' => $userTimeZone,
                    ]);

                    $attendance->save();
                } else {
                    // handle if already has an attendance
                    return $this->errorResponse('Already Logged In', 500);
                }
            } else {
                return $this->errorResponse('You Cannot Checkin Now', 500);
            }
        }


        // check if request has check out
        if ($request->has('check_out') && $request->check_out == 1) {
            // check out validate

            // get time now [ Original Date in UTC timezone which stored in db || dateNow in user time zone to check times in same timezone ]
            $originalDate = Date("h:i A");

            // if($request->has('minutes') && !empty($request->minutes)) {
            //     $originalDate = Date("h:i A", strtotime("- ".$request->minutes." minutes"));
            // }
            $dateNow = Carbon::parse($originalDate)->timezone($userTimeZone)->format('h:i A');
            $canCheckOutAfter = Carbon::parse($today->end_in)->format('h:i A');
            $req_type = null;
            $req = null;

            if (strtotime($dateNow) > strtotime($canCheckOutAfter)) {

                $emp_request = EmployeeRequest::where([
                    'employee_id' => $employee->id,
                    'type' => 'overtime'
                ])->whereDate('created_at', Carbon::today())->latest()->first();


                if (!empty($emp_request)) {

                    if (empty($emp_request->time_to)) {
                        $emp_request->time_to = Date('d-m-Y h:i:s');
                        $emp_request->save();

                        $req = $emp_request;
                        $req_type = 'overtime';


                    } else {
                        return $this->errorResponse('You have Overtime request and already checkout', 500);
                    }

                } else {

                    if (empty($attendance->check_out)) {
                        $attendance->check_out = $originalDate;
                        $attendance->save();
                    }
                }

            } else {
                // check 3ala el overtime request .. _
                return $this->errorResponse('Cannot Check out Now', 500);
            }
            // // handle checkout if employee has any request and difference times from request

            // // end of handlde checkout

            // check if user is on leave or sick leave


            // //from settings get first available time could employee check out
            // $canCheckOutFrom = $this->getEndBefore(Carbon::parse($today->end_in)->timezone($userTimeZone)->format('h:i A'));
            //  //from settings get last available time could employee check in
            // $canCheckOutTo = $this->getEndAfter(Carbon::parse($today->end_in)->timezone($userTimeZone)->format('h:i A'));

            // //check if time now before first time and last time
            // if(strtotime($dateNow) < strtotime($canCheckOutFrom) || strtotime($dateNow) > strtotime($canCheckOutTo)) {
            //     return $this->errorResponse('You can not Check Out Now', 500);
            // }

            //  Store Checkout ;)

        }

        $data = [
            "request_type" => $req_type ?? null,
            "request" => $req ?? null,
            "long" => $branch->longitude,
            "lat" => $branch->latitude,
            "distance" => $shift->distance,
            "start_in" => Carbon::parse($today->start_in)->format('h:i A'),
            "start_before_until" => Carbon::parse($today->early_start_in)->format('h:i A'),
            "start_after_until" => Carbon::parse($today->late_start_in)->format('h:i A'),
            "end_in" => Carbon::parse($today->end_in)->format('h:i A'),
            "end_before_until" => $this->getEndBefore(Carbon::parse($today->end_in)->format('h:i A')),
            "end_after_until" => $this->getEndAfter(Carbon::parse($today->end_in)->format('h:i A')),
            "check_in" => true,
            "check_at" => !empty($attendance->check_in) ? Carbon::parse($attendance->check_in)->timezone($userTimeZone)->format('h:i A') : null,
            "check_out" => empty($attendance?->check_out) ? false : true,
            "check_out_at" => !empty($attendance?->check_out) ? Carbon::parse($attendance->check_out)->timezone($userTimeZone)->format('h:i A') : null,
            "work_hours" => abs((strtotime($today->end_in) - strtotime($today->start_in)) / 3600),
            "difference_work_hours" => !empty($attendance?->check_out) ? abs((strtotime($attendance->check_out) - strtotime($attendance->check_in)) / 3600) : 0,
        ];

        return $this->successResponse($data);
    }

    public function getAttendReport(Request $request)
    {
        // Check request paramteres
        $rules = [
            "today" => "required",
        ];
        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }
        //end Check request paramteres

        $employee = Employee::where([
            'user_id' => auth('api')->user()->id,
            'draft' => 0
        ])->first();

        if ($employee == null) {
            return $this->errorResponse('Employee Not Found', 404);
        }

        if ($request->today == 1) {
            $attendance = Attendance::where('employee_id', $employee->id)->whereDay('created_at', now()->day)->first();
            //return $attendance;
            if (empty($attendance)) {
                return $this->successResponse(new AttendanceResource(new Attendance()));
            }
            return $this->successResponse(new AttendanceResource($attendance));
        } else {
            $attendance = Attendance::where('employee_id', $employee->id)->get();
            return $this->successResponse(AttendanceResource::collection($attendance));
        }

    }

    public function getEmpStatus(Request $request)
    {

        $employee = Employee::where([
            'user_id' => auth('api')->id(),
            'draft' => 0
        ])
            ->select("id", "user_id", "shift_id")
            ->with(["workAt" => function ($query) {
                $query->select('id', 'employee_id', 'workable_type', 'workable_id');
            }])
            ->with(["shift" => function ($query) {
                $query->select('id', "distance");
            }])
            ->first();

        $branch = $this->getEmpBranch($employee);
        $shift = $this->getEmpShift($employee);
        if (!$shift instanceof Shift) {
            return $this->successResponse(["message" => "unactivated"]);
        }

        // $day = Date("D");
        $day = Carbon::now()->format('D');

        $today = ShiftDay::where(["shift_id" => $shift->id, "day_name" => $day])->first();
        if (empty($today)) {
            return $this->successResponse(["message" => "unactivated"]);
        }

        // get employee today attendance
        $attendance = Attendance::where('employee_id', $employee->id)->whereDay('created_at',
            Carbon::today())->first();


        $statusId = Status::where('type', 'employee-requests')->where('name', 'accepted')->value('id');
        $request = EmployeeRequest::where([
            'employee_id' => $employee->id,
            'status_id' => $statusId
        ])
            ->where(function ($query) {
                $query->whereDate('time_from', '>=', Carbon::today());
                $query->whereDate('time_to', '<=', Carbon::today());
            })->
            select('employee_id', 'type', 'name', 'latitude', 'longitude', 'time_from', 'time_to', 'address', 'status_id')->latest()->first();


        if ($request != null) {
            return $this->successResponse(["message" => "request"]);
        }

        if ($attendance == null || $attendance->check_in == null) {
            return $this->successResponse(["message" => "unactivated"]);
        }
        //from settings get first available time could employee check in
        $canCheckInFrom = $this->getStartBefore(Carbon::parse($today->start_in)->format('h:i A'));


        if (strtotime($canCheckInFrom) <= strtotime(Date('d-m-Y h:i:s', strtotime("+1 hours"))) && $attendance->check_in == null) {
            return $this->successResponse(["message" => "absent"]);
        }

        if ($attendance->check_in >= $canCheckInFrom && $attendance->check_out == null) {
            return $this->successResponse(["message" => "attend"]);
        }


        $canCheckOutTo = $this->getEndAfter(Carbon::parse($today->end_in)->format('h:i A'));

        if ($attendance->check_out >= $canCheckOutTo) {
            return $this->successResponse(["message" => "attendAndLeft"]);
        }


        return $this->successResponse(["message" => "unactivated"]);


    }

    public function offline()
    {
        // $offlines = Offline::with(['attendance'=>fn($q)=>$q->with('shift')])->whereDate('created_at', Carbon::today())->get();
        // return response($offlines);
        $employeeId = Employee::where([
            'user_id' => auth('api')->id(),
            'draft' => 0
        ])
            ->value('id');
        if (!$employeeId) {
            return $this->errorResponse('Employee Not Found', 404);
        }
        $attendance = Attendance::where('employee_id', $employeeId)->whereDate('created_at', Carbon::today())->whereNull('check_out')->first();
        if (!$attendance) {
            return $this->errorResponse('No Check In', 404);
        }

        $offline = Offline::whereDate('created_at', Carbon::today())->where('attendance_id' ,$attendance->id)->first();

        if ($offline){
            return $this->errorResponse('Employee Already offline', 500);
        }

        Offline::create(['time' => now(),'attendance_id' => $attendance->id]);
        return $this->successResponse(["message" => "offline status"]);
    }

    public function online()
    {
        $employeeId = Employee::where([
            'user_id' => auth('api')->id(),
            'draft' => 0
        ])
            ->value('id');
        if (!$employeeId) {
            return $this->errorResponse('Employee Not Found', 404);
        }
        $attendanceId = Attendance::where('employee_id', $employeeId)->whereDate('created_at', Carbon::today())->value('id');
        //        if (!$attendance) {
        //            return $this->errorResponse('No Check In', 404);
        //        }

        $offline = Offline::whereDate('created_at', Carbon::today())->where('attendance_id' ,$attendanceId)->first();
        if (!$offline) {
            return $this->errorResponse('Offline Status Not Found', 404);
        }
        $offline->delete();
        return $this->successResponse(["message" => "Back Online"]);
    }
}
