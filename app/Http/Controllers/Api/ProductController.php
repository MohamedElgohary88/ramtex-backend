<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * GET /api/products
     *
     * List all active products with pagination, search, and filters.
     * Performance optimized: preloads category, limits fields.
     *
     * Query Parameters:
     * - search: Fuzzy search on name, item_code, description
     * - category_id: Filter by category
     * - price_min: Minimum price
     * - price_max: Maximum price
     * - sort: price_asc, price_desc, newest
     * - per_page: Items per page (default 15, max 100)
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $perPage = min($perPage, 100);

        $query = Product::query()
            ->where('is_active', true)
            ->with('category:id,name,slug')
            ->select([
                'id',
                'category_id',
                'name',
                'item_code',
                'description',
                'image_path',
                'price',
                'min_stock_alert',
                'stock_on_hand',
                'created_at',
            ]);

        // Search: fuzzy match on name, item_code, or description
        $query->when($request->filled('search'), function ($q) use ($request) {
            $search = $request->query('search');
            $q->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('item_code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        });

        // Filter by category
        $query->when($request->filled('category_id'), function ($q) use ($request) {
            $q->where('category_id', $request->query('category_id'));
        });

        // Filter by price range
        $query->when($request->filled('price_min'), function ($q) use ($request) {
            $q->where('price', '>=', $request->query('price_min'));
        });

        $query->when($request->filled('price_max'), function ($q) use ($request) {
            $q->where('price', '<=', $request->query('price_max'));
        });

        // Sorting
        $sort = $request->query('sort', 'name_asc');
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'newest' => $query->orderByDesc('created_at'),
            default => $query->orderBy('name', 'asc'),
        };

        $products = $query->paginate($perPage);

        return response()->json([
            'data' => ProductResource::collection($products),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
        ], 200);
    }

    /**
     * GET /api/products/{id}
     *
     * Retrieve a single active product with full details.
     *
     * @param  Product  $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        if (! $product->is_active) {
            return response()->json([
                'message' => 'Product not found.',
            ], 404);
        }

        return response()->json([
            'data' => new ProductResource($product->load('category')),
        ], 200);
    }
}
