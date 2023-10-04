<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'type' => $this->type,
                'name' => $this->name,
                'status' => $this->status?->name,
                'time_from' => $this->time_from,
                'time_to' => $this->time_to,
                'response' => $this->response,
                'reason' => $this->reason,
                'project_name' => $this->project_name,
            ];
    }
}
