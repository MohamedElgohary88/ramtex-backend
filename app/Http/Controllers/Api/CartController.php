<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $client = $request->user('client-api');

        $items = $client->cartItems()
            ->with(['product' => function ($query) {
                $query->with(['category:id,name,slug', 'brand:id,name,slug,image'])
                    ->select('id', 'category_id', 'brand_id', 'name', 'item_code', 'description', 'image_path', 'price', 'stock_on_hand', 'is_active', 'created_at');
            }])
            ->get();

        $totals = $this->calculateTotals($items);

        return response()->json([
            'data' => CartItemResource::collection($items),
            'totals' => $totals,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $client = $request->user('client-api');

        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::where('id', $validated['product_id'])
            ->where('is_active', true)
            ->first();

        if (! $product) {
            return response()->json([
                'message' => 'Product not found or inactive.',
            ], 404);
        }

        $cartItem = $client->cartItems()->where('product_id', $product->id)->first();
        $newQuantity = $validated['quantity'] + ($cartItem?->quantity ?? 0);

        if ($product->stock_on_hand < $newQuantity) {
            return response()->json([
                'message' => 'Requested quantity exceeds available stock.',
            ], 422);
        }

        $cartItem = DB::transaction(function () use ($client, $product, $cartItem, $validated, $newQuantity) {
            if ($cartItem) {
                $cartItem->update(['quantity' => $newQuantity]);
            } else {
                $cartItem = CartItem::create([
                    'client_id' => $client->id,
                    'product_id' => $product->id,
                    'quantity' => $validated['quantity'],
                ]);
            }

            return $cartItem->load(['product' => function ($query) {
                $query->with(['category:id,name,slug', 'brand:id,name,slug,image'])
                    ->select('id', 'category_id', 'brand_id', 'name', 'item_code', 'description', 'image_path', 'price', 'stock_on_hand', 'is_active', 'created_at');
            }]);
        });

        $totals = $this->calculateTotals($client->cartItems()->with('product')->get());

        return response()->json([
            'message' => 'Item added to cart',
            'data' => new CartItemResource($cartItem),
            'totals' => $totals,
        ], 201);
    }

    public function update(Request $request, CartItem $cartItem): JsonResponse
    {
        $client = $request->user('client-api');

        if ($cartItem->client_id !== $client->id) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = $cartItem->product()->first();

        if (! $product || ! $product->is_active) {
            return response()->json([
                'message' => 'Product not found or inactive.',
            ], 404);
        }

        if ($product->stock_on_hand < $validated['quantity']) {
            return response()->json([
                'message' => 'Requested quantity exceeds available stock.',
            ], 422);
        }

        $cartItem->update(['quantity' => $validated['quantity']]);

        $cartItem->load(['product' => function ($query) {
            $query->with(['category:id,name,slug', 'brand:id,name,slug,image'])
                ->select('id', 'category_id', 'brand_id', 'name', 'item_code', 'description', 'image_path', 'price', 'stock_on_hand', 'is_active', 'created_at');
        }]);

        $totals = $this->calculateTotals($client->cartItems()->with('product')->get());

        return response()->json([
            'message' => 'Cart item updated',
            'data' => new CartItemResource($cartItem),
            'totals' => $totals,
        ]);
    }

    public function destroy(Request $request, CartItem $cartItem): JsonResponse
    {
        $client = $request->user('client-api');

        if ($cartItem->client_id !== $client->id) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }

        $cartItem->delete();

        $totals = $this->calculateTotals($client->cartItems()->with('product')->get());

        return response()->json([
            'message' => 'Cart item removed',
            'totals' => $totals,
        ]);
    }

    public function clear(Request $request): JsonResponse
    {
        $client = $request->user('client-api');

        $client->cartItems()->delete();

        return response()->json([
            'message' => 'Cart cleared',
            'totals' => [
                'items_count' => 0,
                'grand_total' => 0.0,
            ],
        ]);
    }

    private function calculateTotals($items): array
    {
        $grandTotal = 0;
        $itemsCount = 0;

        foreach ($items as $item) {
            $price = (float) ($item->product->price ?? 0);
            $qty = (int) $item->quantity;
            $grandTotal += $price * $qty;
            $itemsCount += $qty;
        }

        return [
            'items_count' => $itemsCount,
            'grand_total' => $grandTotal,
        ];
    }
}
