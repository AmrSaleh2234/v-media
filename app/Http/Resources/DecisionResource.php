<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class DecisionResource extends MainResource
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
            'id'             => $this->id,
            'name'           => $this->name,
            'branch_id'      => $this->branch_id,
            'group_id'       => $this->group_id,
            'management_id'  => $this->management_id,
            'department_id'  => $this->department_id,
            'attachment'     => $this->attachment,
            'active'         => $this->active,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,

            // relations :
            'group'            => new GroupResource($this->whenLoaded('group')),
            'branch'           => new BranchResource($this->whenLoaded('branch')),
            'management'       => new ManagementResource($this->whenLoaded('management')),
            'department'       => new DepartmentResource($this->whenLoaded('department')),
        ];
    }
}
