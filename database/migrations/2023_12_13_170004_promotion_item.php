<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PromotionItem extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotion_item', function (Blueprint $table) {
            $table->unsignedBigInteger('promotion_id');
            $table->unsignedBigInteger('item_id');

            $table->foreign('promotion_id')->references('id')->on('promotion');
            $table->foreign('item_id')->references('id')->on('item');

            $table->primary(['promotion_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('promotion_item');
    }
};
