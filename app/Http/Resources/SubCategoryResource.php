<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'category_id'    => $this->category_id,
            'name'           => $this->name,
            'slug'           => $this->slug,
            'description'    => $this->description,
            'image'          => $this->image,
            'is_active'      => $this->is_active,
            'sort_order'     => $this->sort_order,
            'category'       => new CategoryResource($this->whenLoaded('category')),
            'products'       => ProductResource::collection($this->whenLoaded('products')),
            'products_count' => $this->when(
                isset($this->products_count),
                $this->products_count
            ),
            'created_at'     => $this->created_at?->toDateTimeString(),
        ];
    }
}