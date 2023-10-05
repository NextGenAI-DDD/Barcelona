<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaLigaTabelaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'club' => [
                'id' => $this->id,
                'rank' => $this->rank,
                'logo' => $this->logo,
                'team' => $this->team,
                'match_played' => $this->match_played,
                'win' => $this->win,
                'draw' => $this->draw,
                'lose' => $this->lose,
                'goals_for' => $this->goals_for,
                'goals_against' => $this->goals_against,
                'goals_diff' => $this->goals_diff,
                'points' => $this->points,
                'form' => $this->form
            ]
        ];
    }
}
