<?php

namespace App\Models\Employee;

use App\Models\Attachment;
use App\Models\Attendance;
use App\Models\Hr\Branch;
use App\Models\Hr\Department;
use App\Models\Hr\Management;
use App\Models\Hr\Relative;
use App\Models\MainModelSoft;
use App\Models\WorkAt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Hr\Shift;
use Carbon\Carbon;

class Employee extends MainModelSoft
{
    use HasFactory;

    protected $fillable = ['email','phone','first_name','last_name','second_name','country_id','city_id','user_id','address',"shift_id"];

    public function country() {
         return $this->hasOne('\App\Models\Country','id','country_id');
    }

    public function city() {
        return $this->hasOne('\App\Models\City','id','city_id');
    }

    public function user() {
        return $this->hasOne('\App\Models\User','id','user_id');
    }

    public function info() {
        return $this->hasOne(EmployeeInfo::class);
    }

    public function academic() {
        return $this->hasMany(EmployeeInfo::class);
    }

    public function experiences() {
        return $this->hasMany(EmployeeExperience::class);
    }

    public function cources() {
        return $this->hasMany(EmployeeCourse::class);
    }

    public function employmentData() {
        return $this->hasOne(EmploymentData::class);
    }

    public function contract() {
        return $this->hasOne(EmploymentContract::class);
    }

    public function finance() {
        return $this->hasOne(EmployeeFinance::class);
    }

    public function dues() {
        return $this->hasMany(EmployeeDue::class);
    }

    public function vacation() {
        return $this->hasOne(EmployeeVacation::class);
    }

    public function relative() {
        return $this->hasOne(Relative::class);
    }

    public function workAt() {
        return $this->hasOne(WorkAt::class,'employee_id','id');
    }

    public function shift() {
        return $this->hasOne(Shift::class,'id','shift_id');
    }

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    public function attendance() {
        return $this->hasone(Attendance::class)->latest();
    }

     public function attachments() {
        return $this->hasMany(Attachment::class,'attachable_id','id')->where('attachable_type', 'employees');
     }

    public function scopeAttendance() {
        return Attendance::where('employee_id',$this->id)->whereDate('created_at', Carbon::today())->first();
    }

    public function getNameAttribute(){
       return $this->first_name . ' ' .$this->last_name ;
    }

    public function requests() {
        return $this->hasMany(EmployeeRequest::class,'employee_id','id');
    }

    public function scopeBranchName() {
        $workAt = $this->workAt;
        if($workAt == null) {
            return "";
        }

        if($workAt->workable instanceof Branch) {
                return Branch::whereId($workAt->workable->id)->select('name')->value('name');
        } else if ($workAt->workable instanceof Management) {
                 return Branch::whereId($workAt->workable->branch_id)->select('name')->value('name');
        } else {
                return Branch::whereId($workAt->workable->management->branch_id)->select('name')->value('name');
        }
    }

    public function scopeManagementName() {
            $workAt = $this->workAt;
            if($workAt == null) {
            return "";
            }

            if($workAt->workable instanceof Branch) {
                return "";
            } else if ($workAt->workable instanceof Management) {
                return Management::whereId($workAt->workable->workable_id)->select('name')->value('name');
            } else {
                return Department::whereId($workAt->workable->management->id)->select('name')->value('name');
            }
    }

    public function scopeBranch($query,$id)
    {
        $managementsId = Management::where('branch_id',$id)->pluck('id')->toArray();
        $departmentsId = Department::whereIn('management_id',$managementsId)->pluck('id')->toArray();

        return $query->whereHas('workAt', function($qr) use ($id,$managementsId,$departmentsId) {
                $qr->where(fn($q)=> $q->where('workable_type','branches')->where('workable_id',$id))
                ->orWhere(fn($q)=>$q->where('workable_type','managements')->whereIn('workable_id',$managementsId))
                ->orWhere(fn($q)=>$q->where('workable_type','departments')->whereIn('workable_id',$departmentsId));
            });

    }

}
