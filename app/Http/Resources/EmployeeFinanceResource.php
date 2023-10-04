<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class EmployeeFinanceResource extends MainResource
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
            'id'            => $this->id,
            'user_id'       => $this->user_id,
            'employee_id'   => $this->employee_id,
            'salary'        => $this->salary,
            'days'          => $this->days,
            'hours'         => $this->hours,
            'hour_type'     => $this->hour_type,
            'allowances'    => $this->allowances,
            'car'           => $this->car,
            'active'        => $this->active,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,

            // relations :
            'user'          => new UserResource($this->whenLoaded('user')),
            'employee'      => new EmployeeResource($this->whenLoaded('employee')),
        ];
    }
}
