<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class SupportResource extends MainResource
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
            'id'         => $this->id,
            'phone'      => $this->phone,
            'name'       => $this->name,
            'email'      => $this->email,
            'status'     => $this->status,
            'type'       => $this->type,
            'content'    => $this->content,
            'card_id'    => $this->card_id,
            'is_read'    => $this->is_read,
            'active'     => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
