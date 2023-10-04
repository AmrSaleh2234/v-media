<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class WorkResource extends MainResource
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
            'id'           => $this->id,
            'user_id'      => $this->user_id,
            'name'         => $this->name,
            'assigned_by'  => $this->assigned_by,
            'duration'     => $this->duration,
            'project_name' => $this->project_name,
            'type'         => $this->type,
            'status'       => $this->status,
            'latitude'     => $this->latitude,
            'longitude'    => $this->longitude,
            'polygon'      => $this->polygon,
            'is_read'      => $this->is_read,
            'active'       => $this->active,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,

            // relations :
            'user'       => new UserResource($this->whenLoaded('user')),
        ];
    }
}
