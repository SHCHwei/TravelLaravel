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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('rid')->comment("room_id");
            $table->integer('cid')->comment("consumer_id");
            $table->timestamp('checkin')->comment("入住日期");
            $table->timestamp('checkout')->comment("退房日期");
            $table->string('money')->comment("付款金額");
            $table->enum('payed', ['0', '1'])->comment("付款狀態");
            $table->enum('payType', ['1', '2', '3'])->comment("付款方式");
            $table->enum('status', ['0', '1', '2', '3'])->comment("訂單狀態");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
