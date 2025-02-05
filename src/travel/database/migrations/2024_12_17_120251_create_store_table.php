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
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("名稱");
            $table->string('address')->comment("地址");
            $table->string('personInCharge')->comment("負責人");
            $table->string('email')->unique()->comment("信箱");
            $table->longText('description')->comment("介紹");
            $table->string('password')->comment("密碼");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store');
    }
};
