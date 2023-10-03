<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueTableData extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'rank',
        'logo',
        'team',
        'played',
        'win',
        'draw',
        'lose',
        'goalsFor',
        'goalsAgainst',
        'goalsDiff',
        'points',
        'form',
    ];


}
