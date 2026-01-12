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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->constrained(); // Created by
            
            $table->string('receipt_number')->unique();
            $table->timestamp('received_at');
            $table->decimal('amount', 15, 2);
            $table->string('payment_method')->default('cash'); // Using string to support Enum
            
            $table->string('check_number')->nullable(); // If payment_method is check
            $table->date('check_date')->nullable();
            $table->string('check_bank')->nullable(); // changed to check_bank to match model
            
            $table->text('notes')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
