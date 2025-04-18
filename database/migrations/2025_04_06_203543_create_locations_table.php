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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('country', 100);
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('district', 100);
            $table->string('street', 255);
            $table->string('address_line', 255);
            $table->string('reference_point', 255)->nullable();
            $table->string('postal_code', 20);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->foreignId('property_id')
                  ->constrained('properties')
                  ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['property_id']);
            $table->index(['country', 'state', 'city']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
