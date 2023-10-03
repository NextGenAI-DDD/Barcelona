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
        Schema::create('la_liga_table', function (Blueprint $table) {
            $table->id();
            $table->integer('rank')->unique();
            $table->string('logo');
            $table->string('team')->unique();
            $table->integer('match_played')->nullable();
            $table->integer('win')->nullable();
            $table->integer('draw')->nullable();
            $table->integer('lose')->nullable();
            $table->integer('goals_for')->nullable();
            $table->integer('goals_against')->nullable();
            $table->integer('goals_diff')->nullable();
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
        Schema::dropIfExists('la_liga_table');
    }
};
