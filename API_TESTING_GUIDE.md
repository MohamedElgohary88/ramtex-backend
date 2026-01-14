# Customer Mobile App API - Test Instructions

## Prerequisites

1. **Server Running:** `php artisan serve` (running on http://localhost:8000)
2. **Postman or cURL:** For testing endpoints
3. **Sample Client Data:** A test client in the database with credentials

## Step 1: Create a Test Client

Open `php artisan tinker` and run:

```php
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

Client::create([
    'full_name' => 'John Doe',
    'company_name' => 'Tech Solutions LLC',
    'email' => 'john@example.com',
    'phone' => '+961-71-123-456',
    'password' => Hash::make('password123'),
    'city' => 'Beirut',
    'country' => 'Lebanon',
]);
```

## Step 2: Test Login Endpoint

### Using cURL

```bash
curl -X POST http://localhost:8000/api/client/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

Or with phone:

```bash
curl -X POST http://localhost:8000/api/client/login \
  -H "Content-Type: application/json" \
  -d '{
    "phone": "+961-71-123-456",
    "password": "password123"
  }'
```

### Response (Success)

```json
{
  "token": "1|abc123xyz...",
  "client": {
    "id": 1,
    "name": "John Doe",
    "company": "Tech Solutions LLC",
    "email": "john@example.com",
    "phone": "+961-71-123-456",
    "city": "Beirut",
    "country": "Lebanon",
    "created_at": "2026-01-14T10:30:00.000000Z",
    "updated_at": "2026-01-14T10:30:00.000000Z"
  }
}
```

## Step 3: Test Product Catalog (Public)

### List All Products

```bash
curl -X GET "http://localhost:8000/api/products?per_page=10"
```

### Response

```json
{
  "data": [
    {
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
      "stock_available": 150,
      "in_stock": true
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 10,
    "total": 45
  }
}
```

### Get Single Product

```bash
curl -X GET http://localhost:8000/api/products/1
```

## Step 4: Test Authenticated Endpoints

### Get Current Client Profile

```bash
curl -X GET http://localhost:8000/api/client/me \
  -H "Authorization: Bearer 1|abc123xyz..."
```

### Response

```json
{
  "client": {
    "id": 1,
    "name": "John Doe",
    "company": "Tech Solutions LLC",
    "email": "john@example.com",
    "phone": "+961-71-123-456",
    "city": "Beirut",
    "country": "Lebanon",
    "created_at": "2026-01-14T10:30:00.000000Z",
    "updated_at": "2026-01-14T10:30:00.000000Z"
  }
}
```

### Logout

```bash
curl -X POST http://localhost:8000/api/client/logout \
  -H "Authorization: Bearer 1|abc123xyz..."
```

## Step 5: Using Postman

### Create Environment Variables

1. Open Postman → Environment Settings
2. Add variable: `base_url` = `http://localhost:8000`
3. Add variable: `client_token` = (leave blank, will populate after login)

### Login Request

**Method:** POST  
**URL:** `{{base_url}}/api/client/login`  
**Headers:**
- `Content-Type: application/json`

**Body (JSON):**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Pre-request Script:**
```javascript
// No script needed for login
```

**Tests (Post-response Script):**
```javascript
var jsonData = pm.response.json();
pm.environment.set("client_token", jsonData.token);
```

### Authenticated Requests

For any authenticated endpoint (like `/api/client/me` or `/api/client/logout`), add:

**Headers:**
- `Authorization: Bearer {{client_token}}`

## Step 5: Test Order Creation (Checkout)

### Create an Order

```bash
curl -X POST http://localhost:8000/api/client/orders \
  -H "Authorization: Bearer 1|abc123xyz..." \
  -H "Content-Type: application/json" \
  -d '{
    "items": [
      {
        "product_id": 1,
        "quantity": 2
      },
      {
        "product_id": 2,
        "quantity": 5
      }
    ],
    "notes": "Please deliver after 5 PM"
  }'
```

### Response (Success - 201)

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

### Error: Out of Stock (422)

```json
{
  "message": "Insufficient stock for T-Shirt Red. Available: 1, Requested: 5.",
  "errors": {
    "items": ["Insufficient stock for T-Shirt Red. Available: 1, Requested: 5."]
  }
}
```

### Error: Product Not Found (422)

```json
{
  "message": "Product ID 999 does not exist or is inactive.",
  "errors": {
    "items": ["Product ID 999 does not exist or is inactive."]
  }
}
```

## Step 6: Retrieve Order History

### Get All Orders for Client

```bash
curl -X GET "http://localhost:8000/api/client/orders?per_page=10" \
  -H "Authorization: Bearer 1|abc123xyz..."
```

### Response

```json
{
  "data": [
    {
      "id": 1,
      "invoice_number": "INV-2026-00001",
      "status": "draft",
      "invoice_date": "2026-01-14T10:30:00.000000Z",
      "items": [
        {
          "id": 1,
          "product": { ... product details ... },
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
  ],
  "meta": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 10,
    "total": 1
  }
}
```

## Error Handling

### Invalid Credentials (401)

```json
{
  "message": "Invalid email/phone or password.",
  "errors": {
    "credentials": ["Invalid email/phone or password."]
  }
}
```

### Missing Required Fields (422)

```json
{
  "message": "The email field is required when phone is not present.",
  "errors": {
    "email": ["The email field is required when phone is not present."]
  }
}
```

### Inactive Product (404)

```json
{
  "message": "Product not found."
}
```

### Insufficient Stock (422)

```json
{
  "message": "Insufficient stock for T-Shirt Red. Available: 0, Requested: 5.",
  "errors": {
    "items": ["Insufficient stock for T-Shirt Red. Available: 0, Requested: 5."]
  }
}
```

## Performance Notes

- Product listing queries only select necessary fields (`id`, `name`, `price`, etc.)
- Category data is eager-loaded to avoid N+1 queries
- Image paths use `asset()` helper for proper public URL generation
- Pagination caps at 100 items per page to prevent abuse
- Order creation validates all stock levels before creating the invoice
- All endpoints use proper HTTP status codes (200, 201, 401, 404, 422)

## Security

- Client passwords are hashed using Laravel's Hash facade
- Sanctum API tokens are used for stateless authentication
- The `client-api` guard ensures mobile app requests are isolated from admin sessions
- Inactive products are excluded from listing and detail endpoints
- Stock validation happens server-side before invoice creation
- All input is validated before processing

## Next Steps

1. Implement product search/filtering (by category, price range)
2. Add payment processing (Mark invoice as "paid")
3. Implement order status tracking (draft → posted → shipped → delivered)
4. Implement push notifications for order updates
5. Add payment gateway integration (Stripe/PayPal)
6. Implement review/rating system for products
