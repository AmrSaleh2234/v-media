<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class CourseResource extends MainResource
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
            'id'                   => $this->id,
            'user_id'              => $this->user_id,
            'employee_id'          => $this->employee_id,
            'name'                 => $this->name,
            'comapny'              => $this->comapny,
            'date_at'              => $this->date_at,
            'duration'             => $this->duration,
            'duration_type'        => $this->duration_type,
            'image'                => $this->image,
            'active'               => $this->active,
            'created_at'           => $this->created_at,
            'updated_at'           => $this->updated_at,

            // relations :
            'user'                 => new UserResource($this->whenLoaded('user')),
            'employee'             => new EmployeeResource($this->whenLoaded('employee')),
        ];
    }
}
