<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->timestamp('registration_date');
            $table->timestamp('update_date');
            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('order_status_id')->references('id')->on('order_status');
            $table->foreign('coupon_id')->references('id')->on('coupon');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('order');
    }
};
