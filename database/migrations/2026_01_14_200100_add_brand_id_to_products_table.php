<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('brand_id')
                ->nullable()
                ->after('category_id')
                ->constrained('brands')
                ->nullOnDelete();
        });

        // Optional legacy migration: move string brand column data into brands table
        if (Schema::hasColumn('products', 'brand')) {
            $distinctBrands = DB::table('products')
                ->whereNotNull('brand')
                ->where('brand', '!=', '')
                ->select('brand')
                ->distinct()
                ->get();

            $brandMap = [];

            foreach ($distinctBrands as $row) {
                $name = $row->brand;
                $slugBase = Str::slug($name) ?: Str::random(8);
                $slug = $slugBase;
                $counter = 1;

                // Ensure unique slugs
                while (DB::table('brands')->where('slug', $slug)->exists()) {
                    $slug = $slugBase . '-' . $counter;
                    $counter++;
                }

                $brandId = DB::table('brands')->insertGetId([
                    'name' => $name,
                    'slug' => $slug,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $brandMap[$name] = $brandId;
            }

            // Assign brand_id based on legacy string column
            foreach ($brandMap as $name => $brandId) {
                DB::table('products')
                    ->where('brand', $name)
                    ->update(['brand_id' => $brandId]);
            }

            // Drop legacy column
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('brand');
            });
        }
    }

    public function down(): void
    {
        // Restore legacy string column if needed and backfill from brand relation
        if (! Schema::hasColumn('products', 'brand')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('brand')->nullable()->after('category_id');
            });

            DB::table('products')
                ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
                ->update(['products.brand' => DB::raw('brands.name')]);
        }

        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'brand_id')) {
                $table->dropForeign(['brand_id']);
                $table->dropColumn('brand_id');
            }
        });

        Schema::dropIfExists('brands');
    }
};
