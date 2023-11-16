<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GamesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'game' => [
                'id' => $this->id,
                'referee' => $this->referee,
                'stadium' => $this->stadium,
                'city' => $this->city,
                'date' => $this->date,
                'home_team_name' => $this->home_team_name,
                'home_team_logo' => $this->home_team_logo,
                'home_team_winner' => $this->home_team_winner,
                'away_team_name' => $this->away_team_name,
                'away_team_logo' => $this->away_team_logo,
                'away_team_winner' => $this->away_team_winner,
                'league_name' => $this->league_name,
                'league_logo' => $this->league_logo,
                'league_round' => $this->league_round,
                'goals_home' => $this->goals_home,
                'goals_away' => $this->goals_away,
                'home_penalty' => $this->home_penalty,
                'away_penalty' => $this->away_penalty,
            ]
        ];
    }
}
