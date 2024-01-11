<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Address extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->text('address');
            $table->unsignedBigInteger('user_id');
            $table->boolean('flag_active');
            $table->boolean('flag_delete');
            $table->unsignedBigInteger('city_id');

            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('address');
    }
};
