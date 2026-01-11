<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            
            $table->string('name')->index();
            $table->string('item_code')->unique()->index(); // SKU/Barcode
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            
            // Monetary Fields (Critical Fix: Using Decimal)
            $table->decimal('price', 15, 2)->default(0);
            $table->decimal('wholesale_price', 15, 2)->default(0); // Assuming mapped from other price fields or for future use
            
            $table->integer('min_stock_alert')->default(10);
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
