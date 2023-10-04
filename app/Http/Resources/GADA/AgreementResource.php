<?php

namespace App\Http\Resources\GADA;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgreementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang') === 'en' ? 'en' : 'ar';
        return [
            'content' => $this->content[$lang] ,
        ];
    }
}
