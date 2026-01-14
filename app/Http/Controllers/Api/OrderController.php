<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Models\Client;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function __construct(
        protected InvoiceService $invoiceService
    ) {}

    /**
     * POST /api/client/orders
     *
     * Create a new order (invoice) from mobile app.
     * Automatically fetches all items from the client's cart.
     * Validates cart is not empty, products exist, are active, and have sufficient stock.
     * Clears the cart after successful order creation.
     *
     * @param  Request  $request
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        /** @var Client $client */
        $client = $request->user('client-api');

        // Fetch all cart items for this client
        $cartItems = $client->cartItems()
            ->with('product')
            ->get();

        // Validate cart is not empty
        if ($cartItems->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart is empty. Please add items before placing an order.',
            ]);
        }

        // Validate products exist, are active, and have sufficient stock
        $preparedItems = [];

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $quantity = $cartItem->quantity;

            // Verify product is still active
            if (! $product->is_active) {
                throw ValidationException::withMessages([
                    'items' => "{$product->name} is no longer available.",
                ]);
            }

            // Check stock availability
            if ($product->stock_on_hand < $quantity) {
                throw ValidationException::withMessages([
                    'items' => "Insufficient stock for {$product->name}. Available: {$product->stock_on_hand}, Requested: {$quantity}.",
                ]);
            }

            // Prepare item for InvoiceService
            $preparedItems[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => (float) $product->price, // Use sell price
            ];
        }

        // Create invoice via service
        $invoice = $this->invoiceService->createInvoice(
            client: $client,
            items: $preparedItems,
            vatRate: 0, // No VAT for mobile orders (business rule)
            notes: $request->input('notes') // Optional order notes
        );

        // Clear the cart after successful order creation
        $client->cartItems()->delete();

        return response()->json([
            'message' => 'Order created successfully.',
            'data' => new InvoiceResource($invoice->load('items.product')),
        ], 201);
    }

    /**
     * GET /api/client/orders
     *
     * Retrieve all orders (invoices) for the authenticated client.
     * Paginated results.
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

        $invoices = $client->invoices()
            ->with('items.product')
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return response()->json([
            'data' => InvoiceResource::collection($invoices),
            'meta' => [
                'current_page' => $invoices->currentPage(),
                'last_page' => $invoices->lastPage(),
                'per_page' => $invoices->perPage(),
                'total' => $invoices->total(),
            ],
        ], 200);
    }
}
