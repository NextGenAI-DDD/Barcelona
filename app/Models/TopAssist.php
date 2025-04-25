<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopAssist extends Model
{
    use HasFactory;

    protected $table = 'top_assist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photo',
        'games_appearances',
        'games_minutes',
        'games_position',
        'goals_assists',
        'club_name',
        'club_logo'
    ];
}
