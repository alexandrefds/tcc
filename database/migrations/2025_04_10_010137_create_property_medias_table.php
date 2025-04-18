<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('property_medias', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('media_type');
            $table->string('file_path');
            $table->string('file_type', 50);
            $table->unsignedInteger('file_size');

            $table->foreignId('property_id')
                  ->constrained('properties')
                  ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['property_id', 'media_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_medias');
    }
};
