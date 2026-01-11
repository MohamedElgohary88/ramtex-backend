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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id('stock_movement_id');
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained(); // Nullable for system actions or initial seeding
            
            $table->enum('type', ['in', 'out', 'adjustment'])->index();
            $table->integer('quantity');
            $table->text('notes')->nullable();
            
            $table->nullableMorphs('reference'); // reference_id, reference_type (For Invoice, Return, etc.)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
