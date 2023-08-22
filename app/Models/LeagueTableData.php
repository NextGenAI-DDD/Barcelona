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


    /**
     * The attributes that should be a team name.
     *
     * @var string
     */
    protected $team;

    /**
     * The attributes that should be a value played games in season.
     *
     * @var integer|null
     */
    protected $played;


    /**
     * The attributes that should be a score win.
     *
     * @var integer|null
     */
    protected $win;

    /**
     * The attributes that should be a score draw.
     *
     * @var integer|null
     */
    protected $draw;

    /**
     * The attributes that should be a score loss.
     *
     * @var integer|null
     */
    protected $loss;

    /**
     * The attributes that should be a score goalsFor.
     *
     * @var integer|null
     */
    protected $goalsFor;

    /**
     * The attributes that should be a score goalsAgainst.
     *
     * @var integer|null
     */
    protected $goalsAgainst;

    /**
     * The attributes that should be a score points.
     *
     * @var integer|null
     */
    protected $points;



    /**
     * @return string
     */
    public function getTeam(): string
    {
        return $this->team;
    }

    /**
     * @param string $team
     */
    public function setTeam(string $team): void
    {
        $this->team = $team;
    }

    /**
     * @return int|null
     */
    public function getPlayed(): ?int
    {
        return $this->played;
    }

    /**
     * @param int|null $played
     */
    public function setPlayed(?int $played): void
    {
        $this->played = $played;
    }

    /**
     * @return int|null
     */
    public function getWin(): ?int
    {
        return $this->win;
    }

    /**
     * @param int|null $win
     */
    public function setWin(?int $win): void
    {
        $this->win = $win;
    }

    /**
     * @return int|null
     */
    public function getDraw(): ?int
    {
        return $this->draw;
    }

    /**
     * @param int|null $draw
     */
    public function setDraw(?int $draw): void
    {
        $this->draw = $draw;
    }

    /**
     * @return int|null
     */
    public function getLoss(): ?int
    {
        return $this->loss;
    }

    /**
     * @param int|null $loss
     */
    public function setLoss(?int $loss): void
    {
        $this->loss = $loss;
    }

    /**
     * @return int|null
     */
    public function getGoalsFor(): ?int
    {
        return $this->goalsFor;
    }

    /**
     * @param int|null $goalsFor
     */
    public function setGoalsFor(?int $goalsFor): void
    {
        $this->goalsFor = $goalsFor;
    }

    /**
     * @return int|null
     */
    public function getGoalsAgainst(): ?int
    {
        return $this->goalsAgainst;
    }

    /**
     * @param int|null $goalsAgainst
     */
    public function setGoalsAgainst(?int $goalsAgainst): void
    {
        $this->goalsAgainst = $goalsAgainst;
    }

    /**
     * @return int|null
     */
    public function getPoints(): ?int
    {
        return $this->points;
    }

    /**
     * @param int|null $points
     */
    public function setPoints(?int $points): void
    {
        $this->points = $points;
    }





}
