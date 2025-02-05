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
        Schema::create('consumer', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("姓名");
            $table->enum('gender', [0, 1])->comment('性別');
            $table->string('email')->unique()->comment("信箱");
            $table->string('birthday')->comment("生日");
            $table->string('password')->comment("密碼");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumer');
    }
};
