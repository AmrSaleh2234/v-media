<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class EmployeeManagementResource extends MainResource
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
            'id'               => $this->id,
            'user_id'          => $this->user_id,
            'department_id'    => $this->department_id,
            'management_id'    => $this->management_id,
            'employee_id'      => $this->employee_id,
            'branch_id'        => $this->branch_id,
            'job_id'           => $this->job_id,
            'grade_id'         => $this->grade_id,
            'job_type_id'      => $this->job_type_id,
            'name'             => $this->name,
            'status'           => $this->status,
            'active'           => $this->active,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,

            // relations :
            'user'             => new UserResource($this->whenLoaded('user')),
            'department'       => new DepartmentResource($this->whenLoaded('departments')),
            'management'       => new ManagementResource($this->whenLoaded('management')),
            'employee'         => new EmployeeResource($this->whenLoaded('employees')),
            'branch'           => new BranchResource($this->whenLoaded('branch')),
            'job'              => new JobResource($this->whenLoaded('job')),
            'grade'            => new GradeResource($this->whenLoaded('grade')),
            'job_type'         => new JobTypeResource($this->whenLoaded('jobType')),
        ];
    }
}
