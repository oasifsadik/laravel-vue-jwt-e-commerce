<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'sub_category_id'     => $this->sub_category_id,
            'name'                => $this->name,
            'slug'                => $this->slug,
            'short_description'   => $this->short_description,
            'description'         => $this->description,
            'sku'                 => $this->sku,
            'price'               => (float) $this->price,
            'sale_price'          => $this->sale_price ? (float) $this->sale_price : null,
            'effective_price'     => (float) $this->effective_price,
            'is_on_sale'          => $this->is_on_sale,
            'discount_percentage' => $this->discount_percentage,
            'stock'               => $this->stock,
            'in_stock'            => $this->stock > 0,
            'thumbnail'           => $this->thumbnail,
            'images'              => $this->images ?? [],
            'attributes'          => $this->attributes ?? [],
            'is_active'           => $this->is_active,
            'is_featured'         => $this->is_featured,
            'sort_order'          => $this->sort_order,
            'sub_category'        => new SubCategoryResource($this->whenLoaded('subCategory')),
            'created_at'          => $this->created_at?->toDateTimeString(),
        ];
    }
}