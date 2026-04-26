<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sub_category_id',
        'name',
        'slug',
        'description',
        'short_description',
        'sku',
        'price',
        'sale_price',
        'stock',
        'images',
        'thumbnail',
        'is_active',
        'is_featured',
        'attributes',
        'sort_order',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'is_featured'     => 'boolean',
        'price'           => 'decimal:2',
        'sale_price'      => 'decimal:2',
        'stock'           => 'integer',
        'sort_order'      => 'integer',
        'images'          => 'array',
        'attributes'      => 'array',
        'sub_category_id' => 'integer',
    ];

    // ─── Relationships ─────────────────────────────────────────────

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function category()
    {
        return $this->hasOneThrough(
            Category::class,
            SubCategory::class,
            'id',           // SubCategory foreign key (sub_categories.id)
            'id',           // Category primary key
            'sub_category_id',
            'category_id'
        );
    }

    // ─── Accessors ─────────────────────────────────────────────────

    public function getEffectivePriceAttribute(): float
    {
        return $this->sale_price ?? $this->price;
    }

    public function getIsOnSaleAttribute(): bool
    {
        return !is_null($this->sale_price) && $this->sale_price < $this->price;
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if (!$this->is_on_sale) return null;
        return (int) round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    // ─── Scopes ────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeBySubCategory($query, int $subCategoryId)
    {
        return $query->where('sub_category_id', $subCategoryId);
    }
}