<?php

namespace App\Traits;

use App\Models\Client;
use App\Models\Hr\Branch;
use App\Models\Hr\Department;
use App\Models\Hr\Grade;
use App\Models\Hr\Job;
use App\Models\Hr\JobGrade;
use App\Models\Hr\JobName;
use App\Models\Hr\JobType;
use App\Models\Hr\Management;
use App\Models\Hr\Qualification;
use App\Models\Hr\Shift;
use App\Models\Hr\Specialist;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
use App\Models\City;

use App\Models\User;

use App\Models\State;

use App\Models\Country;

use App\Models\Currency;

use App\Traits\AdminHelperTrait;
use Spatie\Permission\Models\Role;

trait AdminTrait
{

    use AdminHelperTrait;
    protected $user, $type;

    public function authUser()
    {
        return  auth()->user();
    }

    public function authUserID()
    {
        $id = 0;
        $user = $this->authUser();
        if ($user) {
            $id = $user->id;
        }
        return $id;
    }

    public function authUserLocale($locale = "en")
    {
        $lang = $locale;
        $user = $this->authUser();
        if ($user) {
            $lang = $user->locale;
        }
        return $lang;
    }

    public function checkPerm($route_admin)
    {
        $route_name = false;
        $permission = Permission::whereRaw("FIND_IN_SET('$route_admin',name)")->first();
        if ($permission) {
            if(auth('web')->user()->isAbleTo($permission->name)){
                $route_name =  true;
            }
        }
        return $route_name;
    }

    public function getUserType($type = ["account"], $active = -1, $all = true)
    {
        $user = auth()->user();
        $all_data = User::ofTypeArray($type);
        if ($active == 0 || $active == 1) {
            $all_data->where('active', $active);
        }
        $array = $all_data->pluck('name', 'id')->toArray();

        if ($all != false) {
            $array = array(-1 => __('Select User')) + $array;
        }
        return $array;
    }

    public function getCurrencies($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Currency::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Currency')) + $array;
        }
        return $array;
    }

    public function getCountries($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Country::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Country')) + $array;
        }
        return $array;
    }

    public function getStates($country_id = 0,$all = true)
    {
        $array = State::where('country_id',$country_id)->pluck('name', 'id')->toArray();
        if ($all != false) {
            $array = array(0 => __('Select City')) + $array;
        }
        ksort($array);
        return $array;
    }

    public function getAllCities($country_id = 0,$all = true)
    {
        $array = City::where('country_id',$country_id)->pluck('name', 'id')->toArray();
        if ($all != false) {
            $array = array(0 => __('Select City')) + $array;
        }
        ksort($array);
        return $array;
    }

    public function getCities($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = City::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select City')) + $array;
        }
        return $array;
    }
    public function getShifts($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Shift::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Shift')) + $array;
        }
        return $array;
    }
    public function getJobs($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Job::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('None')) + $array;
        }
        return $array;
    }

    public function getJobGrades($all = true,$locale = "en")
    {
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $data = JobGrade::with('grade')->get();
        $array = [];
        foreach ($data as $value) {
            $name = optional($value->grade)->name;
            $array[$value->id] =  $name;
        }
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Job Grade')) + $array;
        }
        return $array;
    }

    public function getJobTypes($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = JobType::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Job Type')) + $array;
        }
        return $array;
    }

    public function getJobNames($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = JobName::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Job Name')) + $array;
        }
        return $array;
    }

    public function getGrades($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Grade::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Grade')) + $array;
        }
        return $array;
    }

    public function getEmployeeTypes($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = EmployeeType::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Employee Type')) + $array;
        }
        return $array;
    }

    public function getSpecialists($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Specialist::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Specialist')) + $array;
        }
        return $array;
    }

    public function getQualifications($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Qualification::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Qualification')) + $array;
        }
        return $array;
    }

    public function getUniversities($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = University::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select University')) + $array;
        }
        return $array;
    }

    public function getBranches($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Branch::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Branch')) + $array;
        }
        return $array;
    }

    public function getMainBranches($all = true,$type = "main")
    {
        $array = [];
        $array = Branch::where('type',$type)->pluck('name', 'id')->toArray();
        if ($all != false) {
            $array = array('' => __('Select Branch')) + $array;
        }
        return $array;
    }

    public function getTags($type = "departments")
    {
        $array = Tag::where('type',$type)->pluck('name', 'name')->toArray();
        return $array;
    }

    public function getTagsID($type = "job_grades")
    {
        $array = Tag::where('type',$type)->pluck('name', 'id')->toArray();
        return $array;
    }

    public function getMainManagements($all = true,$type = "main")
    {
        //where('type',$type)->
        $array = [];
        $array = Management::pluck('name', 'id')->toArray();
        if ($all != false) {
            $array = array('' => __('Select Management')) + $array;
        }
        return $array;
    }

    public function getMainDepartments($all = true,$type = "main")
    {
        //where('type',$type)->
        $array = [];
        $array = Department::pluck('name', 'id')->toArray();
        if ($all != false) {
            $array = array('' => __('Select Department')) + $array;
        }
        return $array;
    }

    public function getChildManagements($all = true)
    {
        //where('type',$type)->
        $array = [];
        $array = Management::whereNotNull('parent_id')->pluck('name', 'id')->toArray();
        if ($all != false) {
            $array = array('' => __('Select Management')) + $array;
        }
        return $array;
    }

    public function getChildDepartments($all = true)
    {
        //where('type',$type)->
        $array = [];
        $array = Department::whereNotNull('parent_id')->pluck('name', 'id')->toArray();
        if ($all != false) {
            $array = array('' => __('Select Department')) + $array;
        }
        return $array;
    }

    public function getManagements($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Management::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Management')) + $array;
        }
        return $array;
    }

    public function getDepartments($all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Department::pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Department')) + $array;
        }
        return $array;
    }

    public function getDepartmentParents($all = true,$parent_id = 0,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Department::whereNull('parent_id')->pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('Select Department')) + $array;
        }
        return $array;
    }

    public function getDepartmentChilds($parent_id,$all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Department::where('parent_id',$parent_id)->pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(0=> __('Select Department')) + $array;
        }
        return $array;
    }

    public function getManagementChilds($parent_id,$all = true,$locale = "en")
    {
        $array = [];
        // $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Management::where('parent_id',$parent_id)->pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(0 => __('Select Management')) + $array;
        }
        return $array;
    }

    public function getCategories($type = "service" ,$all = false,$locale = "en")
    {
        $array = [];
        $lang = $this->authUserLocale($locale);
        //orderBy("name->".$lang)->
        $array = Category::where('type',$type)->orderBy("order_id")->pluck('name', 'id')->toArray();
        // if (!empty($array_all)) {
        //     foreach ($array_all as $key => $value) {
        //         $array[$key] = $value[$lang];
        //     }
        // }
        if ($all != false) {
            $array = array(-1 => __('None')) + $array;
        }
        return $array;
    }

    public function getPosts($all = true,$locale = "en")
    {
        $array = [];
        $lang = $this->authUserLocale($locale);
        $array_all = Post::orderBy("order_id")->orderBy("name->".$lang)->pluck('name', 'id')->toArray();
        if (!empty($array_all)) {
            foreach ($array_all as $key => $value) {
                $array[$key] = $value[$lang];
            }
        }
        if ($all != false) {
            $array = array(-1 => __('None')) + $array;
        }
        return $array;
    }

    public function getServices($all = true,$locale = "en")
    {
        $array = [];
        $lang = $this->authUserLocale($locale);
        $array_all = Service::orderBy("order_id")->orderBy("name->".$lang)->pluck('name', 'id')->toArray();
        if (!empty($array_all)) {
            foreach ($array_all as $key => $value) {
                $array[$key] = $value[$lang];
            }
        }
        if ($all != false) {
            $array = array(-1 => __('Select Service')) + $array;
        }
        return $array;
    }

    public function getPages($all = true,$locale = "en")
    {
        $array = [];
        $lang = $this->authUserLocale($locale);
        $array_all = Page::orderBy("order_id")->orderBy("name->".$lang)->pluck('name', 'id')->toArray();
        if (!empty($array_all)) {
            foreach ($array_all as $key => $value) {
                $array[$key] = $value[$lang];
            }
        }
        if ($all != false) {
            $array = array(-1 => __('None')) + $array;
        }
        return $array;
    }

    public function getPage($type)
    {
        return Page::active()->where('type','page')->where('page_type',$type)->select()->first();
    }


    public function getRoles($all = false)
    {
        $array = Role::pluck('name', 'id')->toArray();
        if ($all != false) {
            $array = array(-1 => __('None')) + $array;
        }
        return $array;
    }

    public function getUsers($all = true)
    {
        $all_data = User::active();
        $data = $all_data->select('phone', 'name', 'id')->get();
        $array = [];
        foreach ($data as $value) {
            $name = $value->name . ' - ' . $value->phone;
            $array[$value->id] =  $name;
        }
        if ($all != false) {
            $array = array(-1 => __('None')) + $array;
        }
        return $array;
    }

    public function getClients($all = true)
    {
        $all_data = Client::active();
        $data = $all_data->select('phone', 'name', 'id')->get();
        $array = [];
        foreach ($data as $value) {
            $name = $value->name . ' - ' . $value->phone;
            $array[$value->id] =  $name;
        }
        if ($all != false) {
            $array = array(-1 => __('None')) + $array;
        }
        return $array;
    }

    public function getAllManagements($all = true,$branch_id = 0,$with = "no")
    {
        $array = [];
        if($branch_id > 0 || $with != "no"){
            $array = Management::where('branch_id',$branch_id)->pluck('name', 'id')->toArray();
        }else{
            $array = Management::pluck('name', 'id')->toArray();
        }
        if ($all != false) {
            $array = array(0 => __('Select Management')) + $array;
        }
        return $array;
    }

    public function getAllDepartments($all = true,$management_id = 0,$with = "no")
    {
        $array = [];
        if($management_id > 0 || $with != "no"){
            $array = Department::where('management_id',$management_id)->pluck('name', 'id')->toArray();
        }else{
            $array = Department::pluck('name', 'id')->toArray();
        }
        if ($all != false) {
            $array = array(0 => __('Select Department')) + $array;
        }
        return $array;
    }

}
