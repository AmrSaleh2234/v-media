<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class BranchResource extends MainResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'content'       => $this->content,
            'address'       => $this->address,
            'user_id'       => $this->user_id,
            'country_id'    => $this->country_id,
            'manger_id'     => $this->manger_id,
            'shift_id'      => $this->shift_id,
            // 'name'          => $this->name[$this->changeLang()],
            // 'content'       => $this->content[$this->changeLang()],
            // 'address'       => $this->address[$this->changeLang()],
            'icon'          => $this->icon,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'type'          => $this->type,
            'manger_name'   => $this->manger_name,
            'is_clients'    => $this->is_clients,
            'is_mangers'    => $this->is_mangers,
            'is_services'   => $this->is_services,
            'is_papers'     => $this->is_papers,
            'is_projects'   => $this->is_projects,
            'is_shifts'     => $this->is_shifts,
            'image'         => $this->image,
            'attachment'    => $this->attachment,
            'latitude'      => $this->latitude,
            'longitude'     => $this->longitude,
            'polygon'       => $this->polygon,
            'order_id'      => $this->order_id,
            'active'        => $this->active,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            // relations :
            // 'user'          => new UserResource($this->whenLoaded('user')),
            'country'       => new CountryResource($this->whenLoaded('country')),
            'manger'        => new UserResource($this->whenLoaded('manger')),
            'shift'         => new ShiftResource($this->whenLoaded('shift')),
        ];
    }
}
