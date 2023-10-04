<?php

namespace App\Http\Resources\CMS;

use App\Http\Resources\AppMediaResource;
use App\Http\Resources\AttachmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang') == 'en' ? 'en' : 'ar';
        $image = $this->main_image ? asset('storage/' . $this->main_image) : null;
        return [
            'id' => $this->id,
            'name' => $this->name[$lang],
            'title' => $this->title[$lang],
            'description' => $this->description[$lang],
            'link' => $this->link,
            'main-image' => $image,
            'active' => $this->active,
            'project_type_id' => $this->project_type_id,

//            'media' => $this->getMedia('app-thumb'),

            'projectType' => new ProjectTypeResource($this->whenLoaded('projectType')),

            'workZones' => ServicePivotResource::collection($this->whenLoaded('services')),
            'attachments' => AttachmentResource::collection($this->whenLoaded('attachments')),
        ];
    }
}
