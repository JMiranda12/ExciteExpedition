<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Promotion extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotion', function (Blueprint $table) {
            $table->id();
            $table->integer('discount'); //desconto em %
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->timestamp('delete_date')->nullable();
            $table->boolean('flag_delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('promotion');
    }
};
