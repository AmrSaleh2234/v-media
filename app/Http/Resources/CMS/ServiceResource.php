<?php

namespace App\Http\Resources\CMS;

use App\Http\Resources\MainResource;

class ServiceResource extends MainResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = $this->image ? asset('/storage/' . $this->image) : null;
        $icon = $this->icon ? asset('/storage/' . $this->icon) : null;

        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';

        $files = [];
        if (is_array($this->files )){
            foreach ($this->files as $file) {
                if ($file['path']){
                    $files[] = ['path' => asset('/storage/' . $file['path']), 'description' => $file['description']];
                }
            }
        }
        return [
            'id' => $this->id,
            'name' => $this->name[$lang],
            'description' => $this->description[$lang],
            'short_description' => $this->short_description[$lang] ?? null,
            'details' => $this->details,
            'link' => $this->link,
            'color' => $this->color,
            'icon' => $icon,
            'category_id' => $this->category_id,
            'order_id' => $this->order_id,
            'image' => $image,
            'examples' => $files,


            // relations :
//                        'category'  => new ServiceResource($this->whenLoaded('category')),
            'parent' => new ServiceResource($this->whenLoaded('parent')),
            'workZones' => new ServicePivotResource($this->whenLoaded('companyProjects')),

//            'attachments'  => new AttachmentResource($this->whenLoaded('attachments')),
        ];

    }
}
