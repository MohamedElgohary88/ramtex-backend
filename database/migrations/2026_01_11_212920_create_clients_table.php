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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable()->index();
            $table->string('full_name')->index();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable()->index();
            $table->string('other_phone')->nullable();
            $table->string('fax')->nullable();
            
            // Commercial / Financial Data
            $table->string('financial_number')->nullable()->comment('MOF / Tax ID');
            $table->string('bank_details')->nullable();
            
            // Address Data
            $table->text('address')->nullable();
            $table->string('city')->nullable()->index();
            $table->string('district')->nullable();
            $table->string('pobox')->nullable();
            $table->string('country')->nullable()->default('Lebanon'); // Simplifying legacy country_id
            
            // Demographics (Legacy simplification)
            $table->string('gender')->nullable(); // Simplifying gender_id
            $table->string('job_title')->nullable(); // Simplifying job_id
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
