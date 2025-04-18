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
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->decimal('size', 10, 2);
            $table->integer('bedrooms')->nullable();
            $table->integer('suites')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('garages')->nullable();
            $table->integer('living_rooms')->nullable();
            $table->integer('dining_rooms')->nullable();
            $table->integer('kitchens')->nullable();
            $table->integer('pantry')->nullable();
            $table->integer('gardens')->nullable();
            $table->integer('pools')->nullable();
            $table->boolean('barbecue_area')->nullable();
            $table->decimal('condominium_fee', 10, 2)->nullable();
            $table->decimal('annual_tax', 10, 2)->nullable();
            $table->boolean('pet_friendly')->nullable();
            $table->boolean('newer');
            $table->integer('construction_year')->nullable();
            $table->json('extra_info')->nullable();

            $table->foreignId('property_id')
                ->constrained('properties')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['property_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_details');
    }
};
