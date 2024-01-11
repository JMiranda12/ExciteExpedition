<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Payment extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
        $table->id();
        $table->timestamp('register_date');
        $table->timestamp('payment_date')->nullable();
        $table->timestamp('deadline')->nullable();
        $table->unsignedBigInteger('payment_status_id');
        $table->unsignedBigInteger('order_id');

        $table->foreign('payment_status_id')->references('id')->on('payment_status');
        $table->foreign('order_id')->references('id')->on('order');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
