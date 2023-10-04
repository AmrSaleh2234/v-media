<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class EmployeeVacationResource extends MainResource
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
            'vacation_id'         => $this->vacation_id,
            'name'                => $this->name,
            'type'                => $this->type,
            'date_hiring'         => $this->date_hiring,
            'date_due'            => $this->date_due,
            'balance'             => $this->balance,
            'duration'            => $this->duration,
            'from_balance'        => $this->from_balance,
            'without_permission'  => $this->without_permission,
            'active'              => $this->active,
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at,

            // relations :
            'user'                => new UserResource($this->whenLoaded('user')),
            'employee'            => new EmployeeResource($this->whenLoaded('employee')),
            'vacation'            => new VacationResource($this->whenLoaded('vacation')),
        ];
    }
}
