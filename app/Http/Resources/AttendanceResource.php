<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;
use Carbon\Carbon;
class AttendanceResource extends MainResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $timezone = timezone($request->ip());

        if($timezone == "") {
            $timezone = "Africa/Cairo";
        }
        $hourlyValue = $this->employee?->finance?->hourly_value ?? 0;
        $workHours = ! empty($this->check_out) ? abs((strtotime($this->check_out) -
        strtotime($this->check_in)) /3600 ) : 0;
        return [
            'check_in' => $this->check_in != null ? Carbon::parse($this->check_in)->timezone($timezone)->format('h:i A') : null,
            'check_out'=> $this->check_out != null ? Carbon::parse($this->check_out)->timezone($timezone)->format('h:i A') : null,
            'overtime' => 0,
            'fees' => round(($hourlyValue * $workHours),2) . ' ' . $this->employee?->finance?->currency?->name,
            'hourly_value' => round($hourlyValue, 2) . ' ' . $this->employee?->finance?->currency?->name,
            'date' => $this->created_at != null ? Date('Y-m-d H:i:s', strtotime($this->created_at)) : null,
        ];
    }
}
