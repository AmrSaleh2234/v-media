<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class DayShiftResource extends MainResource
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
            'id'              => $this->id,
            'day_id'          => $this->day_id,
            'employee_id'     => $this->employee_id,
            'user_id'         => $this->user_id,
            'day_name'        => $this->day_name,
            // 'day_name'        => $this->day_name[$this->changeLang()],
            'time_start'      => $this->time_start,
            'time_end'        => $this->time_end,
            'time_different'  => $this->time_different,
            'day_start'       => $this->day_start,
            // 'day_start'       => $this->day_start[$this->changeLang()],
            'day_end'         => $this->day_end,
            // 'day_end'         => $this->day_end[$this->changeLang()],
            'day_different'   => $this->day_different,
            // 'day_different'   => $this->day_different[$this->changeLang()],
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,

            // relations :
            'day'             => new DayResource($this->whenLoaded('day')),
            'employee'        => new EmployeeResource($this->whenLoaded('employee')),
            'user'            => new UserResource($this->whenLoaded('user')),

        ];
    }
}
