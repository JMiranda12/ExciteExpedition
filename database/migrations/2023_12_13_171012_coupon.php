<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Coupon extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('dicount'); //desconto em %
            $table->boolean('flag_active');
            $table->text('description')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('coupon');
    }
};
