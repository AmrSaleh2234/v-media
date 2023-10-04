<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

use App\Models\Hr\Branch;
use App\Models\Hr\Department;
use App\Models\Hr\Management;

class EmployeeResource extends MainResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $branchName = "";
        $managementName = "";
        $departamentName = "";

         
            if(!empty($this->workAt)) {
                if($this->workAt->workable instanceof Branch) {
                $branchName = $this->workAt->workable->name;
                }



                if($this->workAt->workable instanceof Management) {
                $managementName = $this->workAt->workable->name;
                $branchName = $this->workAt->workable->branch?->name;
                }

                if($this->workAt->workable instanceof Department) {
                $branchName = $this->workAt->workable->management->branch->name;
                $managementName = $this->workAt->workable->management->name;
                $departamentName = $this->workAt->workable->name;

                }
            }
         
        

        return [
           'full_name' => $this->first_name .' '. $this->second_name.' '.$this->last_name,
           'phone' => $this->phone,
           'address' => $this->address,
           'city' => $this->city?->name,
           'country' => $this->country?->name,
           'personal_photo' => url('/storage/'.$this->info?->personal_photo),
           'id_number' => $this->info?->id_number,
           'national_id' => $this->info?->national_id,
           'passport_no' => $this->info?->passport_no,
           'nationality' => $this->info?->nationality,
           'gender' => $this->info?->gender,
           'birth_date' => $this->info?->birth_date,
           'job_name' => $this->employmentData?->jobName?->name,
           'job_type' => $this->employmentData?->jobType?->name,
           'job_grade' => $this->employmentData?->jobGrade?->grade->name,
           'branch' => $branchName,
           "management" => $managementName,
           "department" => $departamentName,

        ];
    }
}
