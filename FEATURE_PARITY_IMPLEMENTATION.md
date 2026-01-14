# Mobile API - Feature Parity Updates

## ✅ IMPLEMENTATION COMPLETE

Three critical "User Experience" features added to close B2C gaps:

---

## 🆕 Feature 1: Customer Self-Registration

### Endpoint
```
POST /api/client/register
```

### Request Body
```json
{
  "full_name": "Jane Smith",
  "email": "jane@example.com",
  "phone": "+961-71-987-654",
  "password": "password123",
  "password_confirmation": "password123",
  "company_name": "Optional Corp",
  "city": "Beirut",
  "country": "Lebanon"
}
```

### Validation Rules
- `full_name`: Required, max 255 chars
- `email`: Required, unique in clients table, valid email format
- `phone`: Required, unique in clients table, max 30 chars
- `password`: Required, confirmed, minimum 6 characters
- `company_name`, `city`, `country`: Optional

### Response (201 Created)
```json
{
  "message": "Registration successful.",
  "token": "2|xyz123abc...",
  "client": {
    "id": 2,
    "name": "Jane Smith",
    "company": "Optional Corp",
    "email": "jane@example.com",
    "phone": "+961-71-987-654",
    "city": "Beirut",
    "country": "Lebanon",
    "created_at": "2026-01-14T12:00:00.000000Z",
    "updated_at": "2026-01-14T12:00:00.000000Z"
  }
}
```

### Error Responses

**Email Already Exists (422):**
```json
{
  "message": "This email is already registered.",
  "errors": {
    "email": ["This email is already registered."]
  }
}
```

**Phone Already Exists (422):**
```json
{
  "message": "This phone number is already registered.",
  "errors": {
    "phone": ["This phone number is already registered."]
  }
}
```

**Password Confirmation Mismatch (422):**
```json
{
  "message": "Password confirmation does not match.",
  "errors": {
    "password": ["Password confirmation does not match."]
  }
}
```

### Testing
```bash
curl -X POST http://localhost:8000/api/client/register \
  -H "Content-Type: application/json" \
  -d '{
    "full_name": "Jane Smith",
    "email": "jane@example.com",
    "phone": "+961-71-987-654",
    "password": "password123",
    "password_confirmation": "password123",
    "city": "Beirut"
  }'
```

---

## 🔍 Feature 2: Advanced Product Search & Filtering

### Endpoint
```
GET /api/products
```

### Query Parameters

| Parameter | Type | Description | Example |
|-----------|------|-------------|---------|
| `search` | string | Fuzzy search on name, item_code, or description | `?search=shirt` |
| `category_id` | integer | Filter by exact category ID | `?category_id=1` |
| `price_min` | decimal | Minimum price (inclusive) | `?price_min=10.00` |
| `price_max` | decimal | Maximum price (inclusive) | `?price_max=100.00` |
| `sort` | string | Sort order: `price_asc`, `price_desc`, `newest`, `name_asc` (default) | `?sort=price_desc` |
| `per_page` | integer | Items per page (default 15, max 100) | `?per_page=20` |

### Examples

**Search by keyword:**
```bash
GET /api/products?search=cotton
```

**Filter by category:**
```bash
GET /api/products?category_id=1
```

**Price range:**
```bash
GET /api/products?price_min=20&price_max=50
```

**Sort by price (highest first):**
```bash
GET /api/products?sort=price_desc
```

**Combined filters:**
```bash
GET /api/products?search=shirt&category_id=1&price_max=100&sort=price_asc&per_page=20
```

### Response Structure
```json
{
  "data": [
    {
      "id": 1,
      "name": "Cotton T-Shirt",
      "item_code": "TSH-001",
      "description": "Classic cotton t-shirt",
      "category": {
        "id": 1,
        "name": "Apparel",
        "slug": "apparel"
      },
      "price": 29.99,
      "image_url": "http://localhost:8000/storage/products/tsh-001.jpg",
      "stock_available": 150,
      "in_stock": true,
      "is_favorite": false
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 3,
    "per_page": 20,
    "total": 45
  }
}
```

### Implementation Details

**Search Logic:**
- Uses `LIKE '%keyword%'` on three fields: `name`, `item_code`, `description`
- Case-insensitive matching
- OR logic between fields (matches any)

**Sorting:**
- `price_asc`: Lowest to highest price
- `price_desc`: Highest to lowest price
- `newest`: Most recently created first
- `name_asc` (default): Alphabetical by name

**Performance:**
- Queries only active products (`is_active = true`)
- Eager loads category to prevent N+1
- Selects specific columns (not full table scan)
- Pagination capped at 100 items/page

---

## ❤️ Feature 3: Favorites / Wishlist

### Database Schema

**New Table:** `client_product` (pivot)

| Column | Type | Notes |
|--------|------|-------|
| id | BIGINT | Primary key |
| client_id | BIGINT | Foreign key to clients (cascade delete) |
| product_id | BIGINT | Foreign key to products (cascade delete) |
| created_at | TIMESTAMP | When favorited |
| updated_at | TIMESTAMP | Last modified |

**Unique Constraint:** `(client_id, product_id)` – prevents duplicate favorites

### Endpoints

#### 1. Toggle Favorite

**Endpoint:** `POST /api/client/favorites`  
**Authentication:** Required (`auth:client-api`)

**Request Body:**
```json
{
  "product_id": 1
}
```

**Response (200 OK) - Added:**
```json
{
  "message": "Product added to favorites.",
  "action": "added",
  "product_id": 1,
  "is_favorite": true
}
```

**Response (200 OK) - Removed:**
```json
{
  "message": "Product removed from favorites.",
  "action": "removed",
  "product_id": 1,
  "is_favorite": false
}
```

**Error - Product Not Found (422):**
```json
{
  "message": "Product not found or inactive.",
  "errors": {
    "product_id": ["Product not found or inactive."]
  }
}
```

**Testing:**
```bash
TOKEN="your_token_here"

# Add to favorites
curl -X POST http://localhost:8000/api/client/favorites \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"product_id": 1}'

# Remove from favorites (same endpoint - toggles)
curl -X POST http://localhost:8000/api/client/favorites \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"product_id": 1}'
```

#### 2. List Favorites

**Endpoint:** `GET /api/client/favorites`  
**Authentication:** Required (`auth:client-api`)

**Query Parameters:**
- `per_page`: Items per page (default 15, max 100)

**Response (200 OK):**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Cotton T-Shirt",
      "item_code": "TSH-001",
      "description": "Classic cotton t-shirt",
      "category": {
        "id": 1,
        "name": "Apparel",
        "slug": "apparel"
      },
      "price": 29.99,
      "image_url": "http://localhost:8000/storage/products/tsh-001.jpg",
      "stock_available": 150,
      "in_stock": true,
      "is_favorite": true
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 15,
    "total": 5
  }
}
```

**Testing:**
```bash
curl -X GET "http://localhost:8000/api/client/favorites?per_page=10" \
  -H "Authorization: Bearer $TOKEN"
```

### Enhanced ProductResource

The `ProductResource` now includes an `is_favorite` field that:
- Checks if the **currently authenticated client** has favorited the product
- Returns `false` if not authenticated (public browsing)
- Returns `true` if product is in client's favorites
- Works across all product endpoints (list, detail, search)

**Example in Product List:**
```json
{
  "id": 5,
  "name": "Blue Jeans",
  "price": 79.99,
  "is_favorite": true  // ← This client has favorited this product
}
```

---

## 📊 Summary of Changes

### Files Created (3)
1. `app/Http/Requests/Api/RegisterClientRequest.php` – Registration validation
2. `app/Http/Controllers/Api/FavoriteController.php` – Wishlist management
3. `database/migrations/2026_01_14_100000_create_client_product_pivot_table.php` – Favorites pivot

### Files Modified (5)
1. `app/Http/Controllers/Api/Auth/ClientAuthController.php` – Added `register()` method
2. `app/Http/Controllers/Api/ProductController.php` – Added search/filter logic to `index()`
3. `app/Http/Resources/ProductResource.php` – Added `is_favorite` field
4. `app/Models/Client.php` – Added `favorites()` relation
5. `app/Models/Product.php` – Added `favoritedBy()` relation
6. `routes/api.php` – Added 3 new routes

### API Endpoints (Now 11 Total)

| Method | Path | Auth | Purpose |
|--------|------|------|---------|
| POST | `/api/client/register` | — | Self-registration |
| POST | `/api/client/login` | — | Authentication |
| POST | `/api/client/logout` | ✓ | Logout |
| GET | `/api/client/me` | ✓ | Profile |
| POST | `/api/client/orders` | ✓ | Create order |
| GET | `/api/client/orders` | ✓ | Order history |
| POST | `/api/client/favorites` | ✓ | Toggle favorite |
| GET | `/api/client/favorites` | ✓ | List favorites |
| GET | `/api/products` | — | Product catalog (with search/filter) |
| GET | `/api/products/{id}` | — | Product details |
| GET | `/api/ping` | — | Health check |

---

## 🎯 Business Impact

### Before
- ❌ Clients required manual creation via Tinker/Admin
- ❌ Product search required browsing all results
- ❌ No way to save products for later
- ❌ Poor discovery experience

### After
- ✅ **Self-service onboarding** – Clients register themselves
- ✅ **Fast product discovery** – Search by name, category, price
- ✅ **Personalization** – Save favorites for quick access
- ✅ **Improved UX** – Filter, sort, search = faster conversions

---

## 🧪 Complete Testing Workflow

### 1. Register New Client
```bash
curl -X POST http://localhost:8000/api/client/register \
  -H "Content-Type: application/json" \
  -d '{
    "full_name": "Test User",
    "email": "test@example.com",
    "phone": "+961-71-999-888",
    "password": "password123",
    "password_confirmation": "password123"
  }'

# Save returned token
TOKEN="<from_response>"
```

### 2. Search Products
```bash
# By keyword
curl "http://localhost:8000/api/products?search=shirt"

# By price range
curl "http://localhost:8000/api/products?price_min=20&price_max=50&sort=price_asc"

# By category
curl "http://localhost:8000/api/products?category_id=1"
```

### 3. Add to Favorites
```bash
curl -X POST http://localhost:8000/api/client/favorites \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"product_id": 1}'
```

### 4. View Favorites
```bash
curl -X GET http://localhost:8000/api/client/favorites \
  -H "Authorization: Bearer $TOKEN"
```

### 5. Create Order from Favorite
```bash
curl -X POST http://localhost:8000/api/client/orders \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"items":[{"product_id":1,"quantity":2}]}'
```

---

## 🔐 Security Notes

### Registration
- Email uniqueness enforced at database level
- Phone uniqueness enforced at database level
- Password hashing via Laravel's Hash facade (bcrypt)
- Password confirmation required (prevents typos)
- Immediate token generation (seamless onboarding)

### Favorites
- Pivot table prevents duplicate favorites (unique constraint)
- Cascade delete: favorites removed if client/product deleted
- Only active products can be favorited
- Favorites filtered by authenticated client (no cross-access)

### Search
- Uses parameterized queries (SQL injection safe)
- LIKE wildcards sanitized by Laravel
- Pagination prevents data leakage
- Only active products exposed

---

## 📈 Performance Optimizations

1. **Eager Loading:**
   - Categories pre-loaded in all product queries
   - Prevents N+1 query problems

2. **Selective Columns:**
   - Queries only fetch necessary fields
   - Reduces memory and transfer overhead

3. **Indexed Searches:**
   - `is_active` column indexed
   - `name`, `item_code`, `category_id` indexed

4. **Pivot Table:**
   - Unique constraint on `(client_id, product_id)` creates composite index
   - Fast lookups for `is_favorite` checks

5. **Pagination:**
   - All list endpoints paginated (default 15, max 100)
   - Prevents timeout on large datasets

---

## ✅ Status: FEATURE PARITY COMPLETE

All three UX gaps closed:
- [x] Self-registration (no admin intervention needed)
- [x] Advanced search & filtering (fast discovery)
- [x] Favorites/wishlist (personalization)

**Mobile API now provides full B2C experience.** 🎉
