<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaLigaTable extends Model
{
    use HasFactory;

    protected $table = 'la_liga_table';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rank',
        'logo',
        'team',
        'match_played',
        'win',
        'draw',
        'lose',
        'goals_for',
        'goals_against',
        'goals_diff',
        'points',
        'form',
    ];


}
