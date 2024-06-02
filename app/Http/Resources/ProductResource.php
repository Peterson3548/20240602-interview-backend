<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'official_price' => $this->official_price,
            'actual_price' => $this->actual_price,
            'image_url' => $this->image_url,
        ];
    }
}
