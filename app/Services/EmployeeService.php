<?php
namespace App\Services;

use App\Models\Address;
use App\Models\Employee\Employee;
use App\Models\Employee\EmployeeAcademic;
use App\Models\Employee\EmployeeCourse;
use App\Models\Employee\EmployeeDue;
use App\Models\Employee\EmployeeExperience;
use App\Models\Employee\EmployeeFinance;
use App\Models\Employee\EmployeeInfo;
use App\Models\Employee\EmployeeVacation;
use App\Models\Employee\EmploymentContract;
use App\Models\Employee\EmploymentData;
use App\Models\Hr\Relative;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\WorkAt;

class EmployeeService extends MainService {

    public function fetchAll() {
        return Employee::get();
    }

    public function store($data) {


          $user = User::create([
          'name' => $data['first_name'] . ' ' . $data['last_name'],
          'email' => $data['email'],
          'password' => Hash::make("default"),
          ]);

          $data['user_id'] = $user->id;
          $employee = Employee::create($data);
          return $employee;

        // $data['academic']['employee_id'] = $employee->id;
        // $this->storeAcademice($data['academic']);

        // $data['cources']['employee_id'] = $employee->id;
        // $this->storeCources($data['cources']);

        // $data['dues']['employee_id'] = $employee->id;
        // $this->storeDues($data['dues']);

        // $data['experince']['employee_id'] = $employee->id;
        // $this->storeExperinces($data['experince']);

        // $data['finance']['employee_id'] = $employee->id;
        // $this->storeFinance($data['finance']);

        // $data['vacation']['employee_id'] = $employee->id;
        // $this->storeVacation($data['vacation']);

        // $data['contract']['employee_id'] = $employee->id;
        // $this->storeContract($data['contract']);

        // $data['employment_data']['employee_id'] = $employee->id;
        // $this->storeEmploymentData($data['employment_data']);
    }

    public function update($data, $id) {
        $emp = Employee::whereId($id)->first();
        $emp->update($data);
    }

    public function storeAcademice($data, $id = null) {
        if($id != null) {
            if(gettype($data) != "array") {
                return $data->save();
            }
            $empAcadmic = EmployeeAcademic::find($id);
            $empAcadmic->update($data);
            return $empAcadmic;
        }
        return EmployeeAcademic::create($data);
    }

    public function storeCources($data, $id = null) {
        if($id != null) {
            if(gettype($data) != "array") {
                return $data->save();
            }
            $course = EmployeeCourse::find($id);
            return $course->update($data);
        }
      return EmployeeCourse::create($data);
    }


    public function storeDues($employee_id, $name, $values) {
        $empDue = EmployeeDue::where('employee_id',$employee_id)->where('name' , $name)->first();
        if($empDue) {
            if(gettype($values) == "boolean" && $values == false ) {
               return $empDue->delete();
            }

            if(array_key_exists("active",$values) && $values["active"] == false) {
                $empDue->update([
                'value' =>  json_encode($values),
            ]);
                 return $empDue->delete();
            }

            return $empDue->update([
                'value' =>  json_encode($values),
            ]);
        } else {
          return EmployeeDue::create([
                'employee_id' => $employee_id,
                'name' => $name,
                'value' => json_encode($values),
            ]);
        }
    }

    public function getDues($employee_id) {
        $employee = Employee::findOrFail($employee_id);
        return $employee->dues;
    }

    public function storeExperinces($data) {
        if(array_key_exists("id",$data)) {
            $exp = EmployeeExperience::where('id',$data["id"])->first();
            if($exp) {
               return $exp->update($data);
            } else {
                return EmployeeExperience::create($data);
            }
        } else {
            return EmployeeExperience::create($data);
        }

    }

    public function storeFinance($data, $emp_id) {
        $employeeFinance = EmployeeFinance::where('employee_id',$emp_id)->first();
        if($employeeFinance) {
           if(gettype($data) == "array") {
            return $employeeFinance->update($data);
           } else {
            return $employeeFinance->update([
            'salary' => $data['salary'],
            'work_days_in_week' => $data['work_days_in_week'],
            'work_hours' => $data['work_hours'],
            'hour_type' => $data['hour_type'],
            'allowances' => $data['allowances'],
            'car_allownce' => $data['car_allownce'],
            'total' => $data['total'],
            'hourly_value' => $data['hourly_value'],
            'minute_value' => $data['minute_value'],
           ]);
           }
        } else {
            $data['employee_id'] = $emp_id;
           return EmployeeFinance::create($data);
        }

    }

    public function storeInfo($data, $id) {
        $info = EmployeeInfo::where('employee_id',$id)->first();
        if($info) {
            $info->update($data);
        } else {
            $data['employee_id'] = $id;
            EmployeeInfo::create($data);
        }

    }

    public function storeVacation($data) {
        $vacation = EmployeeVacation::where('employee_id', $data['employee_id'])->first();
        if($vacation) {
           return $vacation->update([
            'name' => $data['name'],
            'type' => $data['type'],
            'date_of_hiring' => $data['date_of_hiring'],
            'due_date' => $data['due_date'],
            'mechanism_before_duration' => $data['mechanism_before_duration'],
            'vacation_credit' => $data['vacation_credit'],
            'work_duration' => $data['work_duration'],
            'vacation_deduction' => $data['vacation_deduction'],
            'without_warning' => $data['without_warning'],
           ]);
        } else {
           return EmployeeVacation::create($data);
        }
    }

    public function storeContract($data , $emp_id) {
        $EmploymentContract = EmploymentContract::where('employee_id',$emp_id)->first();
        if($EmploymentContract) {
            $EmploymentContract->update($data);
        } else {
            $data['employee_id'] = $emp_id;
            EmploymentContract::create($data);
        }
    }

    public function storeEmploymentData($data, $emp_id) {
        $employmentData = EmploymentData::where('employee_id',$emp_id)->first();
        if($employmentData) {
            $employmentData->update($data);
        } else {
            $data['employee_id'] = $emp_id;
            EmploymentData::create($data);
        }
    }

    public function storeAddress($data, $id) {
        $address = Address::where(['addressable_id' => $id, 'addressable_type' => 'employees'])->first();
        if($address) {
             $address->update($data);
        } else {
             Address::create([
                'city_id' => $data['city_id'],
                'address' => $data['address'],
                'addressable_id' => $id,
                'addressable_type' => "employees"
            ]);
        }

    }

    public function storeRelative($data , $id) {
        $relative = Relative::where('employee_id' , $id)->first();
        if($relative) {
            $relative->update($data);
        } else {
            Relative::create([
            'employee_id' => $id,
            'name' => $data['full_name'],
            'type' => $data['relative_Type'],
            'phone' => $data['phone'],
        ]);
        }


    }

    public function destroyAcadmic($id) {
        $acadmic = EmployeeAcademic::find($id);
        $acadmic->delete();
        return 1;
    }

    public function destroyExperince($id) {
        $experiance = EmployeeExperience::find($id);
        $experiance->delete();
        return 1;
    }

    public function destroyCourse($id) {
        $course = EmployeeCourse::find($id);
        $course->delete();
        return 1;
    }

    public function getContract($id) {
        return EmploymentContract::where('employee_id',$id)->first() ?? null;
    }

    public function getEmploymentData($id) {
        return EmploymentData::where('employee_id',$id)->first() ?? null;
    }

    public function getFinance($id){
        return EmployeeFinance::where('employee_id',$id)->first() ?? null;
    }

    public function storeWorkAt($employee_id , $branch_id = null, $management_id = null , $department_id = null) {
        $workAt = WorkAt::where('employee_id',$employee_id)->first();
        if($workAt) {
            //update work at
            if($department_id != null) {
                $workAt->update([
                    'workable_type' => 'departments',
                    'workable_id' => $department_id
                ]);
            } else if ($management_id != null) {
               $workAt->update([
                    'workable_type' => 'managements',
                    'workable_id' => $management_id
                ]);
            } else {
                $workAt->update([
                    'workable_type' => 'branches',
                    'workable_id' => $branch_id
                ]);
            }
        } else {
            if($department_id != null) {
                WorkAt::create([
                    'employee_id' => $employee_id,
                    'workable_type' => 'departments',
                    'workable_id' => $department_id
                ]);
            } else if ($management_id != null) {
                WorkAt::create([
                    'employee_id' => $employee_id,
                    'workable_type' => 'managements',
                    'workable_id' => $management_id
                ]);
            } else {
                WorkAt::create([
                    'employee_id' => $employee_id,
                    'workable_type' => 'branches',
                    'workable_id' => $branch_id
                ]);
            }
        }
    }


    public function search($term = null, $draft = 0, $branch = null) {

        if(!empty($term)) {
            return Employee::query()
                        ->where('draft',$draft)
                        ->where('first_name','like','%'. $term .'%')
                        ->orWhere('second_name','like','%'. $term .'%')
                        ->orWhere('last_name','like','%'. $term .'%')
                        ->orWhere('email','like','%'. $term .'%')
                        ->orWhere('phone','like','%'. $term .'%')
                        ->orWhere('id', $term);
        } else {
           return Employee::where('draft', $draft);
        }
    }


}
