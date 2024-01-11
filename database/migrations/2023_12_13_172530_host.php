<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Host extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('host', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('registration_date');
            $table->dateTime('update_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('author');
    }
};
