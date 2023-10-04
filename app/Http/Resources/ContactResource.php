<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class ContactResource extends MainResource
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
            'user_id'       => $this->user_id,
            'phone'         => $this->phone,
            'name'          => $this->name,
            // 'name'          => $this->name[$this->changeLang()],
            'email'         => $this->email,
            'title'         => $this->title,
            // 'title'         => $this->title[$this->changeLang()],
            'type'          => $this->type,
            'content'       => $this->content,
            // 'content'       => $this->content[$this->changeLang()],
            'attachment'    => $this->attachment,
            'is_read'       => $this->is_read,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,

            // relations :
            'user'          => new UserResource($this->whenLoaded('user')),
        ];
    }
}
