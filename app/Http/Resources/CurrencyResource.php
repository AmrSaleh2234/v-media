<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class CurrencyResource extends MainResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'code'         => $this->code,
            'name'         => $this->name,
            // 'name'         => $this->name[$this->changeLang()],
            'order_id'     => $this->order_id,
            'active'       => $this->active,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
