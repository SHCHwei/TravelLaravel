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
        Schema::create('room_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("房型名稱");
            $table->text('description')->comment("房型介紹");
            $table->integer('price')->comment("房型價錢");
            $table->integer('count')->comment("房型數量");
            $table->string('sid')->index()->comment("store_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_type');
    }
};
