<?php

namespace Database\Seeders;

use App\Enums\StockMovementType;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Client;
use App\Models\Currency;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Settings & Core: Currencies
            $usd = Currency::create([
                'code' => 'USD',
                'name' => 'US Dollar',
                'symbol' => '$',
                'exchange_rate' => 1.0000,
                'decimal_precision' => 2,
                'is_base' => true,
                'is_active' => true,
            ]);

            $lbp = Currency::create([
                'code' => 'LBP',
                'name' => 'Lebanese Pound',
                'symbol' => 'L.L.',
                'exchange_rate' => 89000.0000,
                'decimal_precision' => 0,
                'is_base' => false,
                'is_active' => true,
            ]);

            // 1. Settings & Core: Admin User
            $admin = User::firstOrCreate([
                'email' => 'admin@ramtex.com',
            ], [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            // 2. Taxonomy: Categories
            $categories = [];
            $categoryNames = ["Men's Wear", "Women's Wear", "Kids", "Fabrics", "Accessories"];
            foreach ($categoryNames as $name) {
                $categories[] = Category::create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => "High quality $name collection.",
                    'image_path' => 'https://placehold.co/600x400/png?text=' . urlencode($name),
                    'is_active' => true,
                ]);
            }

            // 2. Taxonomy: Brands
            $brands = [];
            $brandNames = ["Nike", "Adidas", "Puma", "Zara", "H&M"];
            foreach ($brandNames as $name) {
                $brands[] = Brand::create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'image' => 'https://placehold.co/200x200/png?text=' . urlencode($name),
                    'is_active' => true,
                ]);
            }

            // 3. Products & Stock
            $adjectives = ["Slim Fit", "Classic", "Vintage", "Modern", "Luxury", "Casual", "Formal", "Comfort", "Sport", "Elegant", "Premium", "Basic", "Urban", "Retro", "Chic"];
            $types = ["Shirt", "Trousers", "Jeans", "Jacket", "Coat", "Dress", "Skirt", "Blouse", "Scarf", "Shoes", "Sneakers", "Boots", "Sandals", "Hat", "Cap", "Hoodie", "Sweater", "Blazer", "Shorts", "Polo"];
            
            // Real uploaded images
            $productImages = [
                'products/01KEQH38RDCCJ40S2EVFHXCZMR.png',
                'products/01KF1HSBGKR3PH9KFBADHPFRJB.webp',
                'products/01KF1HV2DCXERHF5RVMBZBRRTQ.webp',
                'products/01KF1HVGK5F17QCG02GXBC2RXK.jpeg',
            ];

            $products = [];

            for ($i = 0; $i < 50; $i++) {
                $adj = $adjectives[array_rand($adjectives)];
                $type = $types[array_rand($types)];
                $name = "$adj $type " . Str::upper(Str::random(3)); // Add random suffix for uniqueness
                $price = rand(1000, 20000) / 100; // 10.00 to 200.00
                $stock = rand(50, 500);

                $category = $categories[array_rand($categories)];
                $brand = $brands[array_rand($brands)];

                $product = Product::create([
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'name' => $name,
                    'item_code' => 'PRD-' . strtoupper(Str::random(6)),
                    'description' => "A great $name for your collection. Features high quality materials and durability.",
                    'image_path' => $productImages[array_rand($productImages)],
                    'price' => $price,
                    'wholesale_price' => $price * 0.85, // 15% margin default
                    'min_stock_alert' => 10,
                    'stock_on_hand' => $stock,
                    'is_active' => true,
                ]);

                // Initial Stock Movement
                StockMovement::create([
                    'product_id' => $product->id,
                    'user_id' => $admin->id,
                    'type' => 'adjustment', 
                    'quantity' => $stock,
                    'notes' => 'Initial Stock Seeding',
                    'reference_type' => null,
                    'reference_id' => null,
                ]);

                $products[] = $product;
            }

            // 4. Clients & Dynamic Pricing
            // Price List
            $vipList = PriceList::create([
                'name' => 'VIP Wholesale',
                'currency_id' => $usd->id,
                'is_active' => true,
            ]);

            // Clients
            Client::create([
                'company_name' => 'Demo Regular Client Ltd',
                'full_name' => 'John Regular',
                'email' => 'client@demo.com',
                'password' => Hash::make('password'),
                'phone' => '+1234567890',
                'price_list_id' => null, // Regular prices
                'address' => '123 Main St, New York',
            ]);

            Client::create([
                'company_name' => 'Demo VIP Client Corp',
                'full_name' => 'Jane VIP',
                'email' => 'vip@demo.com',
                'password' => Hash::make('password'),
                'phone' => '+0987654321',
                'price_list_id' => $vipList->id, // VIP Pricing
                'address' => '456 Elite Ave, Los Angeles',
            ]);

            // Pricing Logic: Attach 20 random products to VIP list with 20% discount
            $randomProducts = collect($products)->random(20);
            foreach ($randomProducts as $p) {
                PriceListItem::create([
                    'price_list_id' => $vipList->id,
                    'product_id' => $p->id,
                    'price' => $p->price * 0.80, // 20% discount
                ]);
            }
        });
    }
}

