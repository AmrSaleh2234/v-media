<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class ManagementResource extends MainResource
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
            'user_id'         => $this->user_id,
            'manger_id'       => $this->manger_id,
            'branch_id'       => $this->branch_id,
            'country_id'      => $this->country_id,
            'parent_id'       => $this->parent_id,
            'name'            => $this->name,
            'phone'           => $this->phone,
            'image'           => $this->image,
            'attachment'      => $this->attachment,
            'status'          => $this->status,
            'active'          => $this->active,
            'note'            => $this->note,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,

            // relations :
            'user'            => new UserResource($this->whenLoaded('user')),
            'manger'          => new UserResource($this->whenLoaded('manger')),
            'branch'          => new BranchResource($this->whenLoaded('branch')),
            'country'         => new CountryResource($this->whenLoaded('country')),
            'parent'          => new ManagementResource($this->whenLoaded('parent')),
        ];
    }
}
