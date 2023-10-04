<?php

namespace App\Http\Resources\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IconResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $logo = $this->logo ?  asset('/storage/'.$this->logo)  : null;
        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';

        return [
            'id'          => $this->id,
            'name'        => $this->name[$lang],
            'type'          => $this->type,
            'logo'        => $logo,
            'link'        => $this->link,

            // relations :
//            'category'  => new ServiceResource($this->whenLoaded('category')),
//            'attachments'  => new AttachmentResource($this->whenLoaded('attachments')),
        ];
    }
}
