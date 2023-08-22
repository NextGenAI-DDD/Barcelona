<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('league_table_data', function (Blueprint $table) {
            $table->id();
            $table->integer('rank')->unique();
            $table->string('logo');
            $table->string('team')->unique();
            $table->integer('played')->nullable();
            $table->integer('win')->nullable();
            $table->integer('draw')->nullable();
            $table->integer('lose')->nullable();
            $table->integer('goalsFor')->nullable();
            $table->integer('goalsAgainst')->nullable();
            $table->integer('goalsDiff')->nullable();
            $table->integer('points')->nullable();
            $table->string('form')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('league_table_data');
    }
};
