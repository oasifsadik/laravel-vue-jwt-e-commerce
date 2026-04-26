<?php

namespace App\Http\Controllers\Api;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubCategoryController extends Controller
{
    /**
     * GET /api/sub-categories
     * List all active sub-categories (filterable by category).
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = SubCategory::active()
            ->with('category')
            ->orderBy('sort_order');

        // ?category_id=1  →  filter by category
        if ($request->filled('category_id')) {
            $query->byCategory((int) $request->category_id);
        }

        // ?category_slug=electronics  →  filter by slug
        if ($request->filled('category_slug')) {
            $query->whereHas('category', fn ($q) =>
                $q->where('slug', $request->category_slug)
            );
        }

        if ($request->boolean('with_products_count')) {
            $query->withCount('products');
        }

        return SubCategoryResource::collection($query->get());
    }

    /**
     * GET /api/sub-categories/{slug}
     * Single sub-category with its parent category.
     */
    public function show(string $slug): SubCategoryResource
    {
        $subCategory = SubCategory::active()
            ->where('slug', $slug)
            ->with('category')
            ->withCount('products')
            ->firstOrFail();

        return new SubCategoryResource($subCategory);
    }

    /**
     * GET /api/sub-categories/{slug}/products
     * Products belonging to a sub-category (paginated).
     */
    public function products(string $slug, Request $request)
    {
        $subCategory = SubCategory::active()->where('slug', $slug)->firstOrFail();

        $query = $subCategory->products()->active();

        // Filters
        if ($request->boolean('in_stock')) {
            $query->inStock();
        }
        if ($request->boolean('featured')) {
            $query->featured();
        }

        // Sort
        $sortBy  = $request->input('sort_by', 'sort_order');
        $sortDir = $request->input('sort_dir', 'asc');
        $allowedSorts = ['sort_order', 'price', 'name', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir === 'desc' ? 'desc' : 'asc');
        }

        $perPage = min((int) $request->input('per_page', 12), 50);
        $products = $query->paginate($perPage);

        return \App\Http\Resources\ProductResource::collection($products);
    }
}