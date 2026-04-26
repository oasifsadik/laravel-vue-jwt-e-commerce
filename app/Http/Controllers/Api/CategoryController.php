<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * GET /api/categories
     * List all active categories (with optional sub-categories).
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Category::active()->orderBy('sort_order');

        // ?with_sub_categories=true  →  eager-load sub-categories
        if ($request->boolean('with_sub_categories')) {
            $query->with(['subCategories' => fn ($q) => $q->active()->orderBy('sort_order')]);
        }

        // ?with_products_count=true  →  append products count via hasManyThrough
        if ($request->boolean('with_products_count')) {
            $query->withCount('products');
        }

        $categories = $query->get();

        return CategoryResource::collection($categories);
    }

    /**
     * GET /api/categories/{slug}
     * Single category with its sub-categories.
     */
    public function show(string $slug): CategoryResource
    {
        $category = Category::active()
            ->where('slug', $slug)
            ->with(['subCategories' => fn ($q) => $q->active()->orderBy('sort_order')])
            ->withCount('products')
            ->firstOrFail();

        return new CategoryResource($category);
    }

    /**
     * GET /api/categories/{slug}/sub-categories
     * All sub-categories under a category.
     */
    public function subCategories(string $slug)
    {
        $category = Category::active()->where('slug', $slug)->firstOrFail();

        $subCategories = $category->subCategories()
            ->active()
            ->withCount('products')
            ->orderBy('sort_order')
            ->get();

        return \App\Http\Resources\SubCategoryResource::collection($subCategories);
    }
}