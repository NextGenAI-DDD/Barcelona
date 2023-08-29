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
        Schema::create('player_laliga_stats', function (Blueprint $table) {
            $table->id();
            $table->foreign('player_id')->references('id')->on('players');
            $table->integer('appearences_games')->nullable();
            $table->integer('lineups_games')->nullable();
            $table->string('minutes_games')->nullable();
            $table->string('rating_games')->nullable();
            $table->integer('total_shots')->nullable();
            $table->integer('in_substitutes')->nullable();
            $table->integer('out_substitutes')->nullable();
            $table->integer('bench_substitutes')->nullable();
            $table->integer('total_on')->nullable();
            $table->integer('total_goals')->nullable();
            $table->integer('conceded_goals')->nullable();
            $table->integer('assists_goals')->nullable();
            $table->integer('saves_goals')->nullable();
            $table->integer('total_passes')->nullable();
            $table->integer('key_passes')->nullable();
            $table->integer('accuracy_passes')->nullable();
            $table->integer('total_tackles')->nullable();
            $table->integer('blocks_tackles')->nullable();
            $table->integer('interceptions_tackles')->nullable();
            $table->integer('total_duels')->nullable();
            $table->integer('won_duels')->nullable();
            $table->integer('attempts_dribbles')->nullable();
            $table->integer('success_dribbles')->nullable();
            $table->integer('past_dribbles')->nullable();
            $table->integer('drawn_fouls')->nullable();
            $table->integer('committed_fouls')->nullable();
            $table->integer('yellow_cards')->nullable();
            $table->integer('yellowred_cards')->nullable();
            $table->integer('red_cards')->nullable();
            $table->integer('won_penalty')->nullable();
            $table->integer('commited_penalty')->nullable();
            $table->integer('scored_penalty')->nullable();
            $table->integer('missed_penalty')->nullable();
            $table->integer('saved_penalty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_laliga_stats');
    }
};
