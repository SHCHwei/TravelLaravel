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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('hotelName')->comment('Hotel Name');
            $table->string('hotelAddress')->comment('Hotel Address');
            $table->string('hotelPhone')->nullable()->comment('Hotel Phone');
            $table->string('hotelEmail')->comment('Hotel Email');
            $table->string('hotelDescription')->nullable()->comment('Hotel Description');
            $table->string('hotelPrice')->comment('Hotel Price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
