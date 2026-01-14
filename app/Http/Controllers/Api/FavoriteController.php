<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FavoriteController extends Controller
{
    /**
     * POST /api/client/favorites
     *
     * Toggle a product as favorite (add/remove from wishlist).
     *
     * @param  Request  $request
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function toggle(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        /** @var Client $client */
        $client = $request->user('client-api');
        $productId = $validated['product_id'];

        // Check if product is active
        $product = Product::where('id', $productId)
            ->where('is_active', true)
            ->first();

        if (! $product) {
            throw ValidationException::withMessages([
                'product_id' => 'Product not found or inactive.',
            ]);
        }

        // Toggle favorite
        $isFavorited = $client->favorites()->where('product_id', $productId)->exists();

        if ($isFavorited) {
            $client->favorites()->detach($productId);
            $message = 'Product removed from favorites.';
            $action = 'removed';
        } else {
            $client->favorites()->attach($productId);
            $message = 'Product added to favorites.';
            $action = 'added';
        }

        return response()->json([
            'message' => $message,
            'action' => $action,
            'product_id' => $productId,
            'is_favorite' => $action === 'added',
        ], 200);
    }

    /**
     * GET /api/client/favorites
     *
     * List all favorited products for the authenticated client.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        /** @var Client $client */
        $client = $request->user('client-api');

        $perPage = (int) $request->query('per_page', 15);
        $perPage = min($perPage, 100);

        $favorites = $client->favorites()
            ->where('is_active', true)
            ->with('category:id,name,slug')
            ->orderByDesc('client_product.created_at')
            ->paginate($perPage);

        return response()->json([
            'data' => ProductResource::collection($favorites),
            'meta' => [
                'current_page' => $favorites->currentPage(),
                'last_page' => $favorites->lastPage(),
                'per_page' => $favorites->perPage(),
                'total' => $favorites->total(),
            ],
        ], 200);
    }
}
