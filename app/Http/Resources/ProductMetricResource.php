<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductMetricResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'label' => $this->product->name,
            'total' => $this->total,
        ];
    }
}
