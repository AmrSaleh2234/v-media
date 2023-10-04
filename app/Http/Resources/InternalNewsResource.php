<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InternalNewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        $lang = $request->header('lang') == 'ar' ? 'ar' : 'en';
        $arr = explode(".",$this->attachment);
        $type = $arr[count($arr) -1] == "pdf" ? "pdf" : "image" ;
        return [
        "id" => $this->id,
        "title" => $this->title[$lang],
        "department" => $this->department?->name,
        "management" => $this->management?->name,
        "attachment" => url('/storage/' . $this->attachment),
        "type" => $type
        ];
    }
}
