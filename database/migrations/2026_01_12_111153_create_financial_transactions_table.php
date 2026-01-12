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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            
            // Signed amount: Positive = Debt (Invoice), Negative = Credit (Payment/Return)
            $table->decimal('amount', 15, 2);
            
            $table->string('type'); // cast to Enum
            $table->nullableMorphs('reference'); // invoice_id, etc.
            
            $table->text('description')->nullable();
            $table->date('transaction_date');
            
            $table->timestamps();

            $table->index(['client_id', 'transaction_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
