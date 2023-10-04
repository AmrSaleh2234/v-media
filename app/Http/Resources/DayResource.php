<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class DayResource extends MainResource
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
            'shift_id'        => $this->shift_id,
            'day'             => $this->day,
            // 'day'             => $this->day[$this->changeLang()],
            'time_start'      => $this->time_start,
            'time_end'        => $this->time_end,
            'time_different'  => $this->time_different,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,

            // relations :
            //'shift'           => new ShiftResource($this->whenLoaded('shift')),
        ];
    }
}
