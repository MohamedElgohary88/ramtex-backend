<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Product;
use App\Models\Client;

class LegacyDataMigrationSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->migrateCategories();
        $this->migrateClients();
        $this->migrateProducts();

        Schema::enableForeignKeyConstraints();
    }

    private function migrateCategories()
    {
        Category::truncate();
        
        $legacyCats = DB::table('tbm_category')->get();
        foreach ($legacyCats as $cat) {
            Category::create([
                'id' => $cat->id,
                'name' => $cat->title,
                'slug' => \Illuminate\Support\Str::slug($cat->title . '-' . $cat->id),
                'is_active' => strtolower($cat->active ?? 'true') === 'true',
                'description' => null, // Legacy doesn't have desc
            ]);
        }
        $this->command->info('Migrated ' . $legacyCats->count() . ' categories.');
    }

    private function migrateClients()
    {
        Client::truncate();

        $legacyClients = DB::table('tbm_client')->get();
        foreach ($legacyClients as $client) {
            Client::create([
                'id' => $client->id,
                'full_name' => $client->fullname,
                'company_name' => $client->companyname ?: $client->fullname, // Fallback
                'email' => $client->email ?: 'client_' . $client->id . '@ramtex.test', // Dummy email if missing
                'password' => Hash::make('12345678'), // Default password
                'phone' => $client->phone,
                'other_phone' => $client->otherphone,
                'fax' => $client->fax,
                'financial_number' => $client->financialno,
                'bank_details' => $client->bankdetails,
                'address' => $client->address,
                'city' => $client->city,
                'district' => $client->district,
                'pobox' => $client->pobox,
                'country' => 'Lebanon', // Defaulting based on data
                'created_at' => $this->parseDate($client->datedate),
                'updated_at' => now(),
            ]);
        }
        $this->command->info('Migrated ' . $legacyClients->count() . ' clients.');
    }

    private function migrateProducts()
    {
        Product::truncate();

        $legacyProducts = DB::table('tbm_products')->get();
        // Track seen codes to handle duplicates
        $seenCodes = [];

        foreach ($legacyProducts as $prod) {
            // Clean price
            $price = (float) filter_var($prod->default_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
            $itemCode = $prod->itemcode;
            if (isset($seenCodes[$itemCode])) {
                $itemCode = $itemCode . '-' . $prod->id;
            }
            $seenCodes[$itemCode] = true;

            Product::create([
                'id' => $prod->id,
                'category_id' => $prod->category_id,
                'name' => $prod->title,
                'item_code' => $itemCode,
                'description' => $prod->title,
                'price' => $price,
                'image_path' => $prod->photo,
                'is_active' => strtolower($prod->active ?? 'true') === 'true',
                'created_at' => $this->parseDate($prod->datedate),
                'updated_at' => now(),
                // Defaulting new required fields
                'stock_on_hand' => 0, 
                'min_stock_alert' => 10,
            ]);
        }
        $this->command->info('Migrated ' . $legacyProducts->count() . ' products.');
    }

    private function parseDate($date)
    {
        return now(); // Force current timestamp to resolve MySQL 1292 error
    }
}
