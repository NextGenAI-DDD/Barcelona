<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class playerLaligaStats extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'player_id',
        'appearences_games',
        'lineups_games',
        'minutes_games',
        'rating_games',
        'in_substitutes',
        'out_substitutes',
        'bench_substitutes',
        'total_shots',
        'total_on',
        'total_goals',
        'conceded_goals',
        'assists_goals',
        'saves_goals',
        'total_passes',
        'key_passes',
        'accuracy_passes',
        'total_tackles',
        'blocks_tackles',
        'interceptions_tackles',
        'total_duels',
        'won_duels',
        'attempts_dribbles',
        'success_dribbles',
        'past_dribbles',
        'drawn_fouls',
        'committed_fouls',
        'yellow_cards',
        'yellowred_cards',
        'red_cards',
        'won_penalty',
        'commited_penalty',
        'scored_penalty',
        'missed_penalty',
        'saved_penalty',
    ];


}
