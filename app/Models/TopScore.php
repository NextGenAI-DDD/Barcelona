<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopScore extends Model
{
    use HasFactory;

    protected $table = 'top_score';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photo',
        'goals',
        'games_appearances',
        'games_minutes',
        'games_position',
        'club_name',
        'club_logo'
    ];
}
