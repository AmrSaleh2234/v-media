<?php

namespace App\Http\Resources\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicePivotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $zone = json_decode($this->pivot->zone);

        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';
        $image = $this->image ?? $this->main_image ?? null ;
            return[
                'name'        => $this->name[$lang],
//            'details'        => $this->details,
                'image'        => asset('storage/'.$image) ,

                'zone'        => $zone->$lang,
                // relations :
//                        'category'  => new ServiceResource($this->whenLoaded('category')),
//            'parent'  => new ServiceResource($this->whenLoaded('parent')),
//            'attachments'  => new AttachmentResource($this->whenLoaded('attachments')),
            ];

    }
}
