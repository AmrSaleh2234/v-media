<?php

namespace App\Http\Resources\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';
        $image = $this->image ? asset('storage/' . $this->image) : null;
        return [
            'name' => $this->name[$lang] ,
//            'description' => $this->description[$lang] ,
//            'link' => $this->link,
            'type' => $this->type,
            'path' => $image
        ];
    }
}
