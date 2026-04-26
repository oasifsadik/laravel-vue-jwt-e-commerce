<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * GET /api/products
     * Paginated product listing with filters & sorting.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Product::active()
            ->with('subCategory.category');

        // ── Filters ────────────────────────────────────────────────
        if ($request->filled('sub_category_id')) {
            $query->bySubCategory((int) $request->sub_category_id);
        }

        if ($request->filled('sub_category_slug')) {
            $query->whereHas('subCategory', fn ($q) =>
                $q->where('slug', $request->sub_category_slug)
            );
        }

        if ($request->filled('category_slug')) {
            $query->whereHas('subCategory.category', fn ($q) =>
                $q->where('slug', $request->category_slug)
            );
        }

        if ($request->boolean('featured')) {
            $query->featured();
        }

        if ($request->boolean('in_stock')) {
            $query->inStock();
        }

        if ($request->boolean('on_sale')) {
            $query->whereNotNull('sale_price')->whereColumn('sale_price', '<', 'price');
        }

        // Price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // Search
        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(fn ($q) =>
                $q->where('name', 'like', $search)
                  ->orWhere('short_description', 'like', $search)
                  ->orWhere('sku', 'like', $search)
            );
        }

        // ── Sort ───────────────────────────────────────────────────
        $allowedSorts = ['sort_order', 'price', 'name', 'created_at'];
        $sortBy  = in_array($request->sort_by, $allowedSorts) ? $request->sort_by : 'sort_order';
        $sortDir = $request->sort_dir === 'desc' ? 'desc' : 'asc';
        $query->orderBy($sortBy, $sortDir);

        // ── Paginate ───────────────────────────────────────────────
        $perPage = min((int) $request->input('per_page', 12), 50);

        return ProductResource::collection($query->paginate($perPage));
    }

    /**
     * GET /api/products/featured
     * Featured products (for homepage/banners).
     */
    public function featured(Request $request): AnonymousResourceCollection
    {
        $limit = min((int) $request->input('limit', 8), 20);

        $products = Product::active()
            ->featured()
            ->inStock()
            ->with('subCategory.category')
            ->orderBy('sort_order')
            ->limit($limit)
            ->get();

        return ProductResource::collection($products);
    }

    /**
     * GET /api/products/{slug}
     * Single product detail.
     */
    public function show(string $slug): ProductResource
    {
        $product = Product::active()
            ->where('slug', $slug)
            ->with('subCategory.category')
            ->firstOrFail();

        return new ProductResource($product);
    }
}