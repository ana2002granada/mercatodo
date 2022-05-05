<?php

namespace App\Http\Resources\Api;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'stock' => $this->stock,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'disabled_at' => $this->disabled_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
