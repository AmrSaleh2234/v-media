<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $image = isset($this->image) ?  asset('/storage/'.$this->image)  : null;
        $register_image = isset($this->register_image) ?  asset('/storage/'.$this->register_image)  : null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'type' => $this->type,
            'image' => $image,
//            'status'         => $this->status?->name,
            'register_number' => $this->register_number,
            'register_image'        => $register_image,
            'agent_name'        => $this->agent_name,
            'letter_head'        => $this->letter_head,
//            'branch_id'      => $this->branch_id,
//            'branch'      => $this->branch->name,
            // relations :
//            'attachment'        => new AttachmentResource($this->whenLoaded('attachment')),
            'attachments'        =>  AttachmentResource::collection($this->whenLoaded('attachments')),

        ];
    }
}
