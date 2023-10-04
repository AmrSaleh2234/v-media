<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $conversions = [];
        $extension = pathinfo($this->original_url, PATHINFO_EXTENSION);
        $directory = pathinfo($this->original_url, PATHINFO_DIRNAME);

        foreach ($this->generated_conversions as $conversion => $true){
            if($true){
                $conversions[$conversion] =  $directory .'/conversions/'. $this->name .'-'. $conversion .'.'.$extension;
            }
        }

        return[
            'name' => $this->file_name,
            'url' => $this->original_url,
            'conversions' => $conversions
        ];
    }
}
