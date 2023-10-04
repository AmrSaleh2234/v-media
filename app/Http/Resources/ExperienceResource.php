<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class ExperienceResource extends MainResource
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
            'id'                  => $this->id,
            'user_id'             => $this->user_id,
            'employee_id'         => $this->employee_id,
            'job_type_id'         => $this->job_type_id,
            'employee_type_id'    => $this->employee_type_id,
            'comapny_id'          => $this->comapny,
            'date_start'          => $this->date_start,
            'date_end'            => $this->date_end,
            'duration'            => $this->duration,
            'duration_type'       => $this->duration_type,
            'image'               => $this->image,
            'active'              => $this->active,
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at,

            // relations :
            'user'                => new UserResource($this->whenLoaded('user')),
            'employee'            => new EmployeeResource($this->whenLoaded('employee')),
            'job_type'            => new JobTypeResource($this->whenLoaded('jobType')),
            'employee_type'       => new EmployeeTypeResource($this->whenLoaded('employeeType')),
        ];
    }
}
