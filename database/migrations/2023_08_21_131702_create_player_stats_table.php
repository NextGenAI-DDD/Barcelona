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
        Schema::create('player_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained(
                table: 'player', indexName: 'id'
            )->onDelete('cascade');
            $table->dateTime('birth_date');
            $table->string('height');
            $table->string('weight');
            $table->string('nationality');
            $table->boolean('injured');
            $table->integer('games_appearences')->nullable();
            $table->integer('games_lineups')->nullable();
            $table->integer('games_minutes')->nullable();
            $table->integer('games_rating')->nullable();
            $table->integer('substitutes_in')->nullable();
            $table->integer('substitutes_out')->nullable();
            $table->integer('substitutes_bench')->nullable();
            $table->integer('shots_total')->nullable();
            $table->integer('shots_on')->nullable();
            $table->integer('goals_total')->nullable();
            $table->integer('goals_conceded')->nullable();
            $table->integer('goals_assists')->nullable();
            $table->integer('goals_saves')->nullable();
            $table->integer('passes_total')->nullable();
            $table->integer('passes_key')->nullable();
            $table->integer('passes_accuracy')->nullable();
            $table->integer('tackles_total')->nullable();
            $table->integer('tackles_blocks')->nullable();
            $table->integer('tackles_interceptions')->nullable();
            $table->integer('duels_total')->nullable();
            $table->integer('duels_won')->nullable();
            $table->integer('dribbles_attempts')->nullable();
            $table->integer('dribbles_success')->nullable();
            $table->integer('dribbles_past')->nullable();
            $table->integer('fouls_drawn')->nullable();
            $table->integer('fouls_committed')->nullable();
            $table->integer('cards_yellow')->nullable();
            $table->integer('cards_yellowred')->nullable();
            $table->integer('cards_red')->nullable();
            $table->integer('penalty_won')->nullable();
            $table->integer('penalty_committed')->nullable();
            $table->integer('penalty_scored')->nullable();
            $table->integer('penalty_missed')->nullable();
            $table->integer('penalty_saved')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('player_stats');
    }
};
