<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopAssistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'player' => [
                    'id' => $this->id,
                    'name' => $this->name,
                    'photo' => $this->photo,
                    'games_appearances' => $this->games_appearances,
                    'games_minutes' => $this->games_minutes,
                    'games_position' => $this->games_position,
                    'goals_assists' => $this->goals_assists,
                    'club_name' => $this->club_name,
                    'club_logo' => $this->club_logo,
            ]
        ];
    }
}
