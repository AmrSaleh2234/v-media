<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class DepartmentResource extends MainResource
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
            'manger_id'      => $this->manger_id,
            'management_id'  => $this->management_id,
            'branch_id'      => $this->branch_id,
            'user_id'        => $this->user_id,
            'name'           => $this->name,
            'manger_name'    => $this->manger_name,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,

            // relations :
            'manger'         => new UserResource($this->whenLoaded('manger')),
            'management'     => new ManagementResource($this->whenLoaded('management')),
            'branch'         => new BranchResource($this->whenLoaded('branch')),
            'user'           => new UserResource($this->whenLoaded('user')),

        ];
    }
}
