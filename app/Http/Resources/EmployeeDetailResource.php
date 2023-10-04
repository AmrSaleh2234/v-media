<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class EmployeeDetailResource extends MainResource
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
            'id'                     => $this->id,
            'user_id'                => $this->user_id,
            'employee_id'            => $this->employee_id,
            'airline'                => $this->airline,
            'airline_first'          => $this->airline_first,
            'airline_second'         => $this->airline_second,
            'airline_price'          => $this->airline_price,
            'airline_duration'       => $this->airline_duration,
            'insurance'              => $this->insurance,
            'insurance_personal'     => $this->insurance_personal,
            'insurance_family'       => $this->insurance_family,
            'insurance_max'          => $this->insurance_max,
            'transfer'               => $this->transfer,
            'transfer_registration'  => $this->transfer_registration,
            'transfer_final'         => $this->transfer_final,
            'transfer_duration'      => $this->transfer_duration,
            'car'                    => $this->car,
            'car_max'                => $this->car_max,
            'created_at'             => $this->created_at,
            'updated_at'             => $this->updated_at,

            // relations :
            'user'                   => new UserResource($this->whenLoaded('user')),
            'employee'               => new EmployeeResource($this->whenLoaded('employee')),
        ];
    }
}
