<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class AcademyResource extends MainResource
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
            'university_id'        => $this->university_id,
            'qualification_id'     => $this->qualification_id,
            'specialist_id'        => $this->specialist_id,
            'date_at'              => $this->date_at,
            'image'                => $this->image,
            'university_name'      => $this->university->name,
            'qualification_name'   => $this->qualification->name,
            'specialist_name'      => $this->specialist->name,
            'note'                 => $this->note,
            'created_at'           => $this->created_at,
            'updated_at'           => $this->updated_at,

            // relations :
            'user'                 => new UserResource($this->whenLoaded('user')),
            'employee'             => new EmployeeResource($this->whenLoaded('employee')),
            'university'           => new UniversityResource($this->whenLoaded('university')),
            'qualification'        => new QualificationResource($this->whenLoaded('qualification')),
            'specialist'           => new SpecialistResource($this->whenLoaded('specialist')),
        ];
    }
}
