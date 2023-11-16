<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'referee',
        'stadium',
        'city',
        'date',
        'home_team_name',
        'home_team_logo',
        'home_team_winner',
        'away_team_name',
        'away_team_logo',
        'away_team_winner',
        'league_name',
        'league_logo',
        'league_round',
        'goals_home',
        'goals_away',
        'home_penalty',
        'away_penalty',
    ];
}
