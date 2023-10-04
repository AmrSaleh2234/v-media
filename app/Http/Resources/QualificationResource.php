<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class QualificationResource extends MainResource
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
            'id'                => $this->id,
            'user_id'           => $this->user_id,
            'university_id'     => $this->university_id,
            'name'              => $this->name,
            'active'            => $this->active,
            'note'              => $this->note,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,

            // relations :
            'user'              => new UserResource($this->whenLoaded('user')),
            'university'        => new UniversityResource($this->whenLoaded('university')),
        ];
    }
}
