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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('firstName')->comment("註冊者-姓");
            $table->string('lastName')->comment("註冊者-名");
            $table->enum('gender', ['man', 'woman'])->comment("性別");
            $table->string('email')->unique()->comment("信箱");
            $table->text('address')->nullable()->comment("地址");
            $table->string('city')->nullable()->comment("城市");
            $table->string('password')->nullable()->comment("密碼");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
