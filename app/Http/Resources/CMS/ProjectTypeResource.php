<?php

namespace App\Http\Resources\CMS;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';

        return[
            'id' => $this->id,
            'name' => $this->name[$lang],
            'color' => $this->color,
            'group' => $this->group
        ];
    }
}
