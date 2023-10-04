<?php
namespace App\Http\Resources;
use App\Http\Resources\DecisionResource;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HomeCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            // 'employee' => new EmployeeResource($this->collection['employee']),
            'decisions' => DecisionResource::collection($this->collection['decisions']),
        ];
    }
}
