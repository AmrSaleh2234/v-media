<?php

namespace App\Http\Livewire\Employee;

use App\Http\Livewire\Basic\BasicForm;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\Employee\Employee;
use App\Models\User;
use App\Services\EmployeeService;
use Livewire\WithFileUploads;

class StepOne extends BasicForm
{
    use WithFileUploads;

    protected $rules = [

        'employee.first_name' => 'required',
        'employee.second_name' => 'required',
        'employee.last_name' => 'required',
        'employee.phone' => 'numeric|required',
        'employee.email' => 'required|email',
        'info.id_number' => 'required_if:info.nationality,==,saudi',
        'info.border_no' => 'nullable',
        'info.passport_no' => 'nullable',
        'info.national_id' => 'required_if:info.nationality,==,egyption',
        'info.gender' => 'required',
        'info.nationality' => 'string|required',
        'info.birth_date' => 'date|required',
        'employee.country_id' => 'required',
        'employee.city_id' => 'required',
        'employee.address' => 'required',
        'motherAddress.country_id' => 'required',
        'motherAddress.city_id' => 'required',
        'motherAddress.address' => 'required',

        'relative.full_name' => 'nullable',
        'relative.phone' => 'nullable',
        'relative.relative_Type' => 'nullable',
        'relative.relative.employee_id' => 'nullable',
    ];

    public $employee_id = null;
    public $employee;
    public $countries = [];
    public $cities = [];
    public $cities_2 = [];
    public $relatives = [];
    public $relativeTypes = [];
    public $motherAddress;
    public $info;
    public $relative;

    public $personalImage;
    public $border_photo;
    public $passport_photo;
    public $national_photo;

    public function mount($employee_id = null) {
        if($employee_id != null) {
            $this->employee_id = $employee_id;
            $this->employee =  Employee::where('id',$employee_id)->first();

            $this->cities = City::where('country_id',$this->employee->country_id)->pluck('name','id')->toArray();

            if($this->employee->motherAddress) {
                 $city =  City::where('id', $this->employee->motherAddress->city_id)->first();
                 $this->cities_2 = City::where('country_id',$city->country_id)->pluck('name','id')->toArray();
                 $this->motherAddress = array('employee_id' => $this->employee_id,'address' => $this->employee->motherAddress->address, 'city_id' =>  $city->id, 'country_id' => $city->country_id);
            } else {
                 $this->motherAddress = array('employee_id' => $this->employee_id, 'address' => '', 'city_id' =>  '', 'country_id' => '');
            }

            if($this->employee->info) {
                $this->info = $this->employee->info;
            }

            if($this->employee->relative) {
                $this->relative = array('employee_id' => $this->employee->id, 'full_name' => $this->employee->relative->name , 'relative_Type' => $this->employee->relative->type, 'phone' => $this->employee->relative->phone);
            } else {
                $this->relative = array('employee_id' => $this->employee->id, 'full_name' => '' , 'relative_Type' => '', 'phone' => '');
            }



        }

        $this->countries = Country::pluck('name','id')->toArray();
        $this->relativeTypes = relativeType();
    }

    public function render()
    {
        return view('livewire.employee.step-one');
    }

    public function save() {
        if(!empty($this->employee_id)) {
            return $this->updateEmp();
        }

        $empService = new EmployeeService();
        $validated = $this->validate();
        if(empty($this->employee_id) && !empty(User::where('email', $validated['employee']['email'])->first())) {
           $this->dispatchBrowserEvent('toastr',
           ['type' => 'error', 'message' => __('validation.unique',['attribute' => __('names.email')])]);
            return;
        }
        $emp = $empService->store($validated["employee"]);

        if($this->personalImage) {
            $this->info['personal_photo'] = uploadFile($this->personalImage, "employees",$emp->id, "personal_photo");
        }
        if($this->border_photo) {
            $this->info['border_photo'] = uploadFile($this->border_photo, "employees",$emp->id, "border_photo");
        }
        if($this->passport_photo) {
            $this->info['passport_photo'] = uploadFile($this->passport_photo, "employees", $emp->id,"passport_photo");
        }
        if($this->national_photo) {
            $this->info['national_photo'] = uploadFile($this->national_photo, "employees", $emp->id,"national_photo");
        }


        $empService->storeInfo($validated['info'], $emp->id);



        $empService->storeAddress($validated["motherAddress"], $emp->id);

        if (!empty($validated["relative"]['full_name']) || !empty($validated["relative"]['name']) || !empty($validated["relative"]['relative_Type']) ){
            $empService->storeRelative($validated["relative"] , $emp->id);
        }


        $this->dispatchBrowserEvent('toastr',
        ['type' => 'success', 'message' => __('message.saved-success')]);

        return redirect()->route('admin.custom.create',['employee_id' => $emp->id, 'step' => 2]);
    }


    public function updateEmp() {

         $this->rules = [

            'employee.first_name' => 'required',
            'employee.second_name' => 'required',
            'employee.last_name' => 'required',
            'employee.phone' => 'numeric|required',
            'employee.email' => 'required|email',
            'info.id_number' => 'required_if:info.nationality,==,saudi',
            'info.border_no' => 'nullable',
            'info.passport_no' => 'nullable',
            'info.national_id' => 'required_if:info.nationality,==,egyption',
            'info.gender' => 'required',
            'info.nationality' => 'string|required',
            'info.birth_date' => 'date|required',
            'employee.country_id' => 'required',
            'employee.city_id' => 'required',
            'employee.address' => 'required',
            'motherAddress.country_id' => 'required',
            'motherAddress.city_id' => 'required',
            'motherAddress.address' => 'required',

            'relative.full_name' => 'nullable',
            'relative.phone' => 'nullable',
            'relative.relative_Type' => 'nullable',
            'relative.relative.employee_id' => 'nullable',
         ];

        $validated = $this->validate();

         if(empty($this->employee_id) && !empty(User::where('email', $validated['employee']['email'])->where('id','<>',$this->employee_id)->first())) {
            $this->dispatchBrowserEvent('toastr',
            ['type' => 'error', 'message' => __('validation.unique',['attribute' => __('names.email')])]);
            return;
         }
        $empService = new EmployeeService();

         // store Employee
         $empService->update($validated['employee'],$this->employee_id);

         if($this->personalImage) {
            $this->info['personal_photo'] = uploadFile($this->personalImage, "employees",$this->employee_id,"personal_photo");
         }
         if($this->border_photo) {
            $this->info['border_photo'] = uploadFile($this->border_photo, "employees",$this->employee_id, "border_photo");
         }
         if($this->passport_photo) {
             $this->info['passport_photo'] = uploadFile($this->passport_photo, "employees", $this->employee_id,"passport_photo");
         }
         if($this->national_photo) {
            $this->info['national_photo'] = uploadFile($this->national_photo, "employees", $this->employee_id,"national_photo");
         }

         $empService->storeInfo($validated["info"], $this->employee_id);


         $empService->storeAddress($this->motherAddress, $this->employee_id);


         $empService->storeRelative($this->relative, $this->employee_id);

         $this->dispatchBrowserEvent('toastr',
         ['type' => 'success', 'message' => __('message.saved-success')]);

         return redirect()->route('admin.custom.create',['employee_id' => $this->employee_id, 'step' => 2]);
    }


    public function updatedpersonalImage()
    {
        $this->validate([
            'personalImage' => 'image|max:1024|mimes:png,jpg,jpeg', // 1MB Max
        ]);

        $this->employee['info']['personal_photo'] = $this->personalImage;
    }


    public function updatedborderPhoto() {
        $this->validate([
            'border_photo' => 'image|max:1024|mimes:png,jpg,jpeg', // 1MB Max
        ]);

        $this->info['border_photo'] = $this->border_photo;
    }

    public function updatedpassportPhoto() {
        $this->validate([
            'passport_photo' => 'image|max:1024|mimes:png,jpg,jpeg', // 1MB Max
        ]);

        $this->info['passport_photo'] = $this->passport_photo;
    }

    public function updatednationalPhoto() {
        $this->validate([
            'national_photo' => 'image|max:1024|mimes:png,jpg,jpeg|required', // 1MB Max
        ]);

        $this->info['national_photo'] = $this->national_photo;
    }

    public function updatedemployeeCountryId() {
       $this->cities = City::where('country_id', $this->employee['country_id'])->pluck('name','id')->toArray();
    }

    public function updatedmotherAddressCountryId() {
       $this->cities_2 = City::where('country_id', $this->motherAddress['country_id'])->pluck('name','id')->toArray();
    }
}
