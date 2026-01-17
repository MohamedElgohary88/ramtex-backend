<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedInteger('sales_rep_id')->nullable()->after('price_list_id');
            // We use simple index as legacy table naming might complicate foreign key constraints
            $table->index('sales_rep_id');
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('sales_rep_id');
        });
    }
};
