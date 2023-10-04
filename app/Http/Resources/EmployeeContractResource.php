<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class EmployeeContractResource extends MainResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                      => $this->id,
            'user_id'                 => $this->user_id,
            'employee_id'             => $this->employee_id,
            'branch_id'               => $this->branch_id,
            'group_id'                => $this->group_id,
            'job_id'                  => $this->job_id,
            'job_grade_id'            => $this->job_grade_id,
            'grade_id'                => $this->grade_id,
            'job_type_id'             => $this->job_type_id,
            'job_name_id'             => $this->job_name_id,
            'management_child_id'     => $this->management_child_id,
            'currency_name'           => $this->currency_name,
            'management_id'           => $this->management_id,
            'date_start_id'           => $this->date_start,
            'date_end_id'             => $this->date_end,
            'date_join'               => $this->date_join,
            'date_test'               => $this->date_test,
            'salary_type'             => $this->salary_type,
            'active'                  => $this->active,
            'created_at'              => $this->created_at,
            'updated_at'              => $this->updated_at,

            // relations :
            'user'                    => new UserResource($this->whenLoaded('user')),
            'employee'                => new EmployeeResource($this->whenLoaded('employee')),
            'branch'                  => new BranchResource($this->whenLoaded('branch')),
            'group'                   => new GroupResource($this->whenLoaded('group')),
            'job'                     => new JobResource($this->whenLoaded('job')),
            'job_grade'               => new JobGradeResource($this->whenLoaded('jobGrade')),
            'grade'                   => new GradeResource($this->whenLoaded('grade')),
            'job_type'                => new JobTypeResource($this->whenLoaded('jobType')),
            'job_name'                => new JobNameResource($this->whenLoaded('jobName')),
            'management_child'        => new ManagementResource($this->whenLoaded('managementChild')),
            // 'currency'                => new CurrencyResource($this->whenLoaded('currency')),
            'management'              => new ManagementResource($this->whenLoaded('management')),
        ];
    }
}
