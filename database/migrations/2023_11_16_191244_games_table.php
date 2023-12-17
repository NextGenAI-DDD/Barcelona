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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('referee')->nullable();
            $table->string('stadium');
            $table->string('city');
            $table->dateTime('date');
            $table->string('home_team_name');
            $table->string('home_team_logo');
            $table->boolean('home_team_winner')->nullable();
            $table->string('away_team_name');
            $table->string('away_team_logo');
            $table->boolean('away_team_winner')->nullable();
            $table->string('league_name');
            $table->string('league_logo');
            $table->string('league_round');
            $table->integer('goals_home')->nullable();
            $table->integer('goals_away')->nullable();
            $table->integer('home_penalty')->nullable();
            $table->integer('away_penalty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
