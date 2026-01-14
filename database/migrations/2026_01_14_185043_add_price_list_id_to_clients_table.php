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
        if (!Schema::hasColumn('clients', 'price_list_id')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->foreignId('price_list_id')->nullable()->constrained('price_lists')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('clients', 'price_list_id')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->dropForeign(['price_list_id']);
                $table->dropColumn('price_list_id');
            });
        }
    }
};
