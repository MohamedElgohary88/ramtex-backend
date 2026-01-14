<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Product;
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
     * Validates stock availability and creates invoice in draft state.
     *
     * @param  StoreOrderRequest  $request
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        /** @var Client $client */
        $client = $request->user('client-api');

        $validated = $request->validated();
        $items = $validated['items'];

        // Validate products exist, are active, and have sufficient stock
        $productIds = collect($items)->pluck('product_id')->unique();
        $products = Product::whereIn('id', $productIds)
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        $preparedItems = [];

        foreach ($items as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];

            // Product exists and is active
            if (! isset($products[$productId])) {
                throw ValidationException::withMessages([
                    'items' => "Product ID {$productId} does not exist or is inactive.",
                ]);
            }

            $product = $products[$productId];

            // Check stock availability
            if ($product->stock_on_hand < $quantity) {
                throw ValidationException::withMessages([
                    'items' => "Insufficient stock for {$product->name}. Available: {$product->stock_on_hand}, Requested: {$quantity}.",
                ]);
            }

            // Prepare item for InvoiceService
            $preparedItems[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => (float) $product->price, // Use sell price
            ];
        }

        // Create invoice via service
        $invoice = $this->invoiceService->createInvoice(
            client: $client,
            items: $preparedItems,
            vatRate: 0, // No VAT for mobile orders (business rule)
            notes: $validated['notes'] ?? null
        );

        return response()->json([
            'message' => 'Order created successfully.',
            'order' => new InvoiceResource($invoice->load('items.product')),
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
