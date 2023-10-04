<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class SettingResource extends MainResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';

        return [
//            'id'         => $this->id,
//            'parent_id'  => $this->parent_id,
//            'group'      => $this->group,
//            'type'       => $this->type,
            'key'        => $this->key,
            'value' => $this->value[$lang] ?? $this->value,

//            $this->key => $this->value[$lang] ?? $this->value,
//            'locale'     => $this->locale,
//            'autoload'   => $this->autoload,

            // relations :
            'parent' => new SettingResource($this->whenLoaded('parent')),
        ];
    }
}
