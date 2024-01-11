<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HostActivity extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('host_activity', function (Blueprint $table) {
            $table->unsignedBigInteger('host_id');
            $table->unsignedBigInteger('activity_item_id');

            $table->foreign('host_id')->references('id')->on('host');
            $table->foreign('activity_item_id')->references('item_id')->on('activity');

            $table->primary(['host_id','activity_item_id']);
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
