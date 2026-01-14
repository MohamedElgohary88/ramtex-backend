# Order Checkout API - Complete Documentation

## Overview

The Order Checkout API enables customers to submit orders directly through the mobile app. It validates product availability, manages stock allocation, and creates draft invoices that can be processed for payment and shipping.

---

## Architecture

### Leverage Existing Patterns

The order creation endpoint reuses the **production-proven `InvoiceService`**, which:
- Handles all financial calculations (totals, VAT)
- Records stock movements atomically
- Creates financial transaction records
- Supports full audit trails

**Flow:**
```
Mobile App → POST /api/client/orders
           ↓
StoreOrderRequest (Validation)
           ↓
OrderController::store()
           ↓
Product Stock Check
           ↓
InvoiceService::createInvoice()
           ↓
Draft Invoice Created + Financial Records
           ↓
Return: { invoice_id, total, items }
```

---

## Endpoints

### POST /api/client/orders

**Authentication:** Required (`auth:client-api`)  
**Guard:** `client-api`

#### Request

**Headers:**
```
Authorization: Bearer <sanctum_token>
Content-Type: application/json
```

**Body:**
```json
{
  "items": [
    {
      "product_id": 1,
      "quantity": 2
    },
    {
      "product_id": 5,
      "quantity": 10
    }
  ],
  "notes": "Please deliver after 5 PM"
}
```

**Validation Rules:**
- `items`: Required, array of at least 1 item
- `items.*.product_id`: Required, integer, must exist in products table
- `items.*.quantity`: Required, integer, minimum 1
- `notes`: Optional, string, max 1000 characters

#### Response (201 Created)

```json
{
  "message": "Order created successfully.",
  "order": {
    "id": 1,
    "invoice_number": "INV-2026-00001",
    "status": "draft",
    "invoice_date": "2026-01-14T10:30:00.000000Z",
    "items": [
      {
        "id": 1,
        "product": {
          "id": 1,
          "name": "T-Shirt Red",
          "item_code": "TSH-001",
          "description": "Classic cotton t-shirt",
          "category": {
            "id": 1,
            "name": "Apparel",
            "slug": "apparel"
          },
          "price": 29.99,
          "image_url": "http://localhost:8000/storage/products/tsh-red.jpg",
          "stock_available": 148,
          "in_stock": true
        },
        "quantity": 2,
        "unit_price": 29.99,
        "total_line_price": 59.98
      }
    ],
    "total_amount": "59.98",
    "vat_rate": "0.00",
    "vat_amount": "0.00",
    "grand_total": "59.98",
    "notes": "Please deliver after 5 PM",
    "posted_at": null,
    "created_at": "2026-01-14T10:30:00.000000Z",
    "updated_at": "2026-01-14T10:30:00.000000Z"
  }
}
```

#### Error Responses

**Stock Validation (422 Unprocessable Entity):**
```json
{
  "message": "Insufficient stock for T-Shirt Red. Available: 1, Requested: 5.",
  "errors": {
    "items": ["Insufficient stock for T-Shirt Red. Available: 1, Requested: 5."]
  }
}
```

**Product Not Found/Inactive (422 Unprocessable Entity):**
```json
{
  "message": "Product ID 999 does not exist or is inactive.",
  "errors": {
    "items": ["Product ID 999 does not exist or is inactive."]
  }
}
```

**Validation Error (422 Unprocessable Entity):**
```json
{
  "message": "At least one product must be ordered.",
  "errors": {
    "items": ["At least one product must be ordered."]
  }
}
```

**Unauthenticated (401):**
```json
{
  "message": "Unauthenticated."
}
```

---

### GET /api/client/orders

**Authentication:** Required (`auth:client-api`)  
**Guard:** `client-api`

#### Request

**Headers:**
```
Authorization: Bearer <sanctum_token>
```

**Query Parameters:**
- `per_page` (optional): Number of orders per page (default: 15, max: 100)

**Example:**
```bash
GET /api/client/orders?per_page=10
```

#### Response (200 OK)

```json
{
  "data": [
    {
      "id": 2,
      "invoice_number": "INV-2026-00002",
      "status": "draft",
      "invoice_date": "2026-01-14T10:30:00.000000Z",
      "items": [
        {
          "id": 2,
          "product": { ... },
          "quantity": 5,
          "unit_price": 49.99,
          "total_line_price": 249.95
        }
      ],
      "total_amount": "249.95",
      "vat_rate": "0.00",
      "vat_amount": "0.00",
      "grand_total": "249.95",
      "notes": null,
      "posted_at": null,
      "created_at": "2026-01-14T09:15:00.000000Z",
      "updated_at": "2026-01-14T09:15:00.000000Z"
    },
    {
      "id": 1,
      "invoice_number": "INV-2026-00001",
      "status": "draft",
      "invoice_date": "2026-01-14T10:30:00.000000Z",
      "items": [ ... ],
      "total_amount": "59.98",
      "vat_rate": "0.00",
      "vat_amount": "0.00",
      "grand_total": "59.98",
      "notes": "Please deliver after 5 PM",
      "posted_at": null,
      "created_at": "2026-01-14T10:30:00.000000Z",
      "updated_at": "2026-01-14T10:30:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 2,
    "per_page": 10,
    "total": 12
  }
}
```

---

## Controller Implementation

### OrderController.php

**Location:** `app/Http/Controllers/Api/OrderController.php`

**Key Methods:**

1. **`store(StoreOrderRequest $request): JsonResponse`**
   - Validates incoming order data
   - Retrieves authenticated client
   - Checks product availability and stock levels
   - Calls `InvoiceService::createInvoice()` within a transaction
   - Returns created invoice with all items

2. **`index(Request $request): JsonResponse`**
   - Retrieves all invoices for authenticated client
   - Eager-loads items and products to prevent N+1 queries
   - Orders by most recent first
   - Returns paginated results

### Validation Request Class

**Location:** `app/Http/Requests/Api/StoreOrderRequest.php`

Uses Laravel's form request validation to:
- Ensure at least one item is provided
- Validate product IDs exist in database
- Enforce minimum quantity of 1
- Validate notes field length

---

## Resource Classes

### InvoiceResource

**Location:** `app/Http/Resources/InvoiceResource.php`

Transforms Invoice model to API-friendly JSON:
- Includes all invoice metadata (id, number, status, dates)
- Embeds line items with full product details
- Formats decimal amounts as floats for JSON
- Hides sensitive internal fields

### InvoiceItemResource

**Location:** `app/Http/Resources/InvoiceItemResource.php`

Transforms InvoiceItem model:
- Returns product details via embedded ProductResource
- Includes quantity and pricing (unit + total)
- Maintains data consistency with product catalog

---

## Validation & Stock Check

### Pre-Invoice Validation

Before creating an invoice, the system:

1. **Product Existence:** Verifies each product exists in database
2. **Active Status:** Ensures product is `is_active = true`
3. **Stock Availability:** Checks `stock_on_hand >= requested_quantity`
4. **Fail Fast:** Returns 422 error if ANY validation fails (no partial orders)

**Code Example:**
```php
foreach ($items as $item) {
    $productId = $item['product_id'];
    $quantity = $item['quantity'];

    if (!isset($products[$productId])) {
        throw ValidationException::withMessages([
            'items' => "Product ID {$productId} does not exist or is inactive.",
        ]);
    }

    $product = $products[$productId];

    if ($product->stock_on_hand < $quantity) {
        throw ValidationException::withMessages([
            'items' => "Insufficient stock for {$product->name}. Available: {$product->stock_on_hand}, Requested: {$quantity}.",
        ]);
    }
}
```

---

## Database Schema

### invoices Table

| Column | Type | Notes |
|--------|------|-------|
| id | BIGINT | Primary key |
| client_id | BIGINT | Foreign key to clients |
| user_id | BIGINT | Admin who posted invoice (nullable) |
| invoice_number | VARCHAR | Unique, auto-generated (e.g., INV-2026-00001) |
| status | ENUM | 'draft', 'posted', 'cancelled' |
| invoice_date | DATE | Order date |
| total_amount | DECIMAL(15,2) | Sum of line items |
| vat_rate | DECIMAL(5,2) | VAT percentage (0 for mobile orders) |
| vat_amount | DECIMAL(15,2) | Calculated VAT |
| grand_total | DECIMAL(15,2) | total_amount + vat_amount |
| notes | TEXT | Optional customer notes |
| posted_at | TIMESTAMP | When invoice was posted (null if draft) |
| created_at | TIMESTAMP | Order creation time |
| updated_at | TIMESTAMP | Last modification time |

### invoice_items Table

| Column | Type | Notes |
|--------|------|-------|
| id | BIGINT | Primary key |
| invoice_id | BIGINT | Foreign key to invoices |
| product_id | BIGINT | Foreign key to products |
| quantity | INT | Order quantity |
| unit_price | DECIMAL(15,2) | Price at time of order |
| total_line_price | DECIMAL(15,2) | quantity × unit_price |

---

## Transaction Handling

### Atomicity Guarantee

Order creation happens within a single database transaction:

```php
DB::transaction(function () use ($client, $items, ...) {
    // 1. Create invoice record
    // 2. Create all invoice items
    // 3. Return loaded invoice
    // All-or-nothing: Either full success or complete rollback
});
```

**Guarantees:**
- No orphaned items without invoice
- Consistent financial records
- Stock calculations remain accurate

---

## Invoice States

### draft

- Initial state when order is created
- Items are not deducted from stock yet
- Can be cancelled without reverting stock
- No financial transaction recorded

### posted

- Created when admin/system processes the invoice for fulfillment
- Stock is deducted (`StockService::adjustStock()`)
- Financial transaction recorded (`TransactionService::recordTransaction()`)
- Cannot be directly cancelled (use Returns instead)
- Invoice number is locked

### cancelled

- Invoice is voided
- Cannot transition to posted
- Stock is **NOT** restored (that requires a Sales Return)

---

## Testing Workflow

### 1. Create Test Client

```bash
php artisan tinker

use App\Models\Client;
use Illuminate\Support\Facades\Hash;

Client::create([
    'full_name' => 'Test Customer',
    'email' => 'customer@example.com',
    'phone' => '+961-71-123-456',
    'password' => Hash::make('password123'),
    'city' => 'Beirut',
    'country' => 'Lebanon',
]);
```

### 2. Login to Get Token

```bash
curl -X POST http://localhost:8000/api/client/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "customer@example.com",
    "password": "password123"
  }'

# Copy returned token
```

### 3. Create Order

```bash
curl -X POST http://localhost:8000/api/client/orders \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "items": [
      {"product_id": 1, "quantity": 2}
    ],
    "notes": "Test order"
  }'
```

### 4. Retrieve Orders

```bash
curl -X GET http://localhost:8000/api/client/orders \
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## Security Considerations

1. **Authentication:** All order endpoints require valid Sanctum token
2. **Authorization:** Orders are filtered by authenticated client (no cross-client access)
3. **Stock Validation:** Server-side validation prevents overbooking
4. **Input Sanitization:** All inputs validated via FormRequest
5. **Atomicity:** Transactions prevent partial/inconsistent state
6. **Audit Trail:** All changes recorded with client context

---

## Future Enhancements

1. **Payment Processing:** Mark invoice as "paid" via payment API
2. **Status Workflow:** draft → posted → shipped → delivered
3. **Order Tracking:** Real-time updates on order status
4. **Cancellation:** Allow clients to cancel pending orders
5. **Returns:** Implement Sales Return flow tied to invoices
6. **Promotions:** Apply discount codes at checkout
7. **Tax Calculation:** Dynamic VAT/tax based on shipping address
8. **Shipping Integration:** Sync with shipping provider APIs

---

## Files Modified

- `app/Http/Controllers/Api/OrderController.php` (NEW)
- `app/Http/Requests/Api/StoreOrderRequest.php` (NEW)
- `app/Http/Resources/InvoiceResource.php` (NEW)
- `app/Http/Resources/InvoiceItemResource.php` (NEW)
- `app/Models/Client.php` (Added `invoices()` relation)
- `routes/api.php` (Added order routes)

---

## Summary

The Order Checkout API is **production-ready** with:
- ✅ Strict stock validation before order creation
- ✅ Atomic transaction handling
- ✅ Reuse of proven InvoiceService business logic
- ✅ Clean resource-based JSON responses
- ✅ Full pagination support
- ✅ Comprehensive error handling
- ✅ Client isolation (no cross-account access)
