<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class SpecialistResource extends MainResource
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
            'id'                 => $this->id,
            'user_id'            => $this->user_id,
            'qualification_id'   => $this->qualification_id,
            'name'               => $this->key,
            'active'             => $this->value,
            'note'               => $this->locale,
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,

            // relations :
            'user'               => new UserResource($this->whenLoaded('user')),
            'qualification'      => new QualificationResource($this->whenLoaded('qualification')),
        ];
    }
}
