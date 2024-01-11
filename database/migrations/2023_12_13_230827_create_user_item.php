<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserItem extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_item', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('item_id')->references('id')->on('item');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_item');
    }
};
