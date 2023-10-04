<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientIdvividualResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $image = isset($this->image) ? asset('/storage/' . $this->image) : null;
        $card_image = isset($this->card_image) ? asset('/storage/' . $this->card_image) : null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'type' => $this->type,
            'image' => $image,
            'card_id' => $this->card_id,
            'card_image' => $card_image,
            'status' => $this->status?->name,
            'letter_head' => $this->letter_head,
            'branch_id' => $this->branch_id,
            'branch' => $this->branch?->name,

            // relations :
            //            'attachment'        => new AttachmentResource($this->whenLoaded('attachment')),
            'attachments' => AttachmentResource::collection($this->whenLoaded('attachments')),
        ];
    }
}
