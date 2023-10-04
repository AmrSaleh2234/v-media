<?php

namespace App\Http\Resources\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $image = isset($this->image) ?  asset('/storage/'.$this->image)  : null;
        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';

        return [
            'id'          => $this->id,
            'name'        => $this->name[$lang],
            'job_title'        => $this->job_title[$lang],
//            'bio'        => $this->bio[$lang],
            'description'        => $this->description[$lang],
            'image'        => $image,
            // relations :
//                        'category'  => new ServiceResource($this->whenLoaded('category')),
//            'attachments'  => new AttachmentResource($this->whenLoaded('attachments')),
        ];
    }
}
