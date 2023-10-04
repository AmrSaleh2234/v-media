<?php

namespace App\Http\Resources;

use App\Http\Resources\MainResource;

class CountryResource extends MainResource
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
            'id'              => $this->id,
            'iso3'            => $this->iso3,
            'name'            => $this->name,
            // 'name'            => $this->name[$this->changeLang()],
            'phonecode'       => $this->phonecode,
            'iso2'            => $this->iso2,
            'numeric_code'    => $this->numeric_code,
            'currency'        => $this->currency,
            'currency_name'   => $this->currency_name,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];
    }
}
