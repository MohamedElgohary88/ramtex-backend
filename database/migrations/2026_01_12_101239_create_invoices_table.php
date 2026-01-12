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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->constrained(); // Created by
            
            $table->string('invoice_number')->unique();
            $table->enum('status', ['draft', 'posted', 'cancelled'])->default('draft')->index();
            $table->date('invoice_date');
            
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->decimal('vat_rate', 5, 2)->default(0); // VAT percentage
            $table->decimal('vat_amount', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2)->default(0); // total_amount + vat_amount
            
            $table->text('notes')->nullable();
            $table->timestamp('posted_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
