<?php

namespace App\Http\Resources\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $image = $this->image ?  asset('/storage/'.$this->image)  : null;
        $thumbnail = $this->thumbnail ?  asset('/storage/'.$this->thumbnail)  : null;

        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';

        return [
            'id'          => $this->id,
            'title'        => $this->title[$lang],
            'content'        => $this->content[$lang],
            'category_id'        => $this->category_id,
            'category'        => $this->category->name[$lang],
            'image'        => $image,
            'thumbnail' => $thumbnail,
            'published_at'        => $this->published,

            // relations :
//                        'category'  => new ServiceResource($this->whenLoaded('category')),
//            'attachments'  => new AttachmentResource($this->whenLoaded('attachments')),
        ];
    }
}
