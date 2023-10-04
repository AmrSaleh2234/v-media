<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class BrokerResource extends MainResource
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
            'user_id'        => $this->user_id,
            'branch_id'      => $this->branch_id,
            'group_id'       => $this->group_id,
            'name'           => $this->name,
            'phone'          => $this->phone,
            'email'          => $this->email,
            'card_id'        => $this->card_id,
            'passport_id'    => $this->passport_id,
            'image'          => $this->image,
            'attachment'     => $this->attachment,
            'address'        => $this->address,
            'card_image'     => $this->card_image,
            'passport_image' => $this->passport_image,
            'status'         => $this->status,
            'active'         => $this->active,
            'note'           => $this->note,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,

            // relations :
            'user'           => new UserResource($this->whenLoaded('user')),
            'branch'         => new BranchResource($this->whenLoaded('branch')),
            'group'          => new GroupResource($this->whenLoaded('group')),
        ];
    }
}
