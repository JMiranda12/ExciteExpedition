<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Activity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id');
            $table->string('title');
            $table->text('description');
            $table->date('first_date')->default('2024-01-01');
            $table->date('last_date')->default('2024-01-31');
            $table->integer('duration')->default('120');
          //  $table->unsignedBigInteger('host_id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');


            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('language_id')->references('id')->on('language');
            $table->foreign('item_id')->references('id')->on('item');
            $table->foreign('country_id')->references('id')->on('country');
            $table->foreign('category_id')->references('id')->on('category');
            $table->primary('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity');
    }
}
