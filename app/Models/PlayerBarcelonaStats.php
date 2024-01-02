<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerBarcelonaStats extends Model
{
    use HasFactory;

    protected $table = 'player_stats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'player_id',
        'birth_date',
        'height',
        'weight',
        'nationality',
        'injured',
        'games_appearances',
        'games_lineups',
        'games_minutes',
        'games_rating',
        'substitutes_in',
        'substitutes_out',
        'substitutes_bench',
        'shots_total',
        'shots_on',
        'goals_total',
        'goals_conceded',
        'goals_assists',
        'goals_saves',
        'passes_total',
        'passes_key',
        'passes_accuracy',
        'tackles_total',
        'tackles_blocks',
        'tackles_interceptions',
        'duels_total',
        'duels_won',
        'dribbles_attempts',
        'dribbles_success',
        'dribbles_past',
        'fouls_drawn',
        'fouls_committed',
        'cards_yellow',
        'cards_yellowred',
        'cards_red',
        'penalty_won',
        'penalty_committed',
        'penalty_scored',
        'penalty_missed',
        'penalty_saved',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class,'player_id');
    }





}
