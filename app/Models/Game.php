<?php

namespace App\Models;

use DateTime;
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

    /**
     * @return mixed
     */
    public function getDate(): ?string
    {
        // Check if $this->date is set and is not an empty string
        if ($this->date !== null && $this->date !== '') {
            // Convert the date string to a DateTime object
            $dateObject = new DateTime($this->date);

            // Format the date
            return $dateObject->format("d.m.Y");
        }

        // If $this->date is not set or empty, return null or handle it as needed
        return null;
    }

    /**
     * @return mixed
     */
    public function getTime(): ?string
    {
        // Check if $this->date is set and is not an empty string
        if ($this->date !== null && $this->date !== '') {
            // Convert the date string to a DateTime object
            $dateObject = new DateTime($this->date);

            // Format the date
            return $dateObject->format("H:i");
        }

        // If $this->date is not set or empty, return null or handle it as needed
        return null;
    }

    /**
     * @return mixed
     */
    public function getNowDate(): ?string
    {
        $now = new DateTime('now');
        return $now->format('Y-m-d H:i:s');
    }




}


