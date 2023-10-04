<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class AttachmentResource extends MainResource
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
//            'id'                   => $this->id,
//            'user_id'              => $this->user_id,
//            'attachmentable_type'  => $this->attachmentable_type,
//            'attachable_id'    => $this->attachmentable_id,
            'path'                 => asset('/storage/'.$this->path),
            'size'                  => $this->size,
            'type'                  => $this->type,
            'original_name'                => $this->original_name,
            'extension'                  => $this->extension,

            // relations :
//            'user'                 => new UserResource($this->whenLoaded('user')),
        ];
    }
}
