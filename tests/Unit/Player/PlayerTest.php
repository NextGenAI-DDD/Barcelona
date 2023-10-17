<?php

namespace Tests\Unit\Player;

use App\Models\Player;
use App\Models\PlayerBarcelonaStats;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    /**
     * Add player with Stats Api.
     */
    public function addPlayerApi(): void
    {
        $player = Player::factory()->make();

        $playerStats = PlayerBarcelonaStats::factory()->make();

        // Prepare stats data for the player
        $playerStatsData = [
            'birth_date' => $playerStats->birth_date,
            'height' => $playerStats->height,
            'weight' => $playerStats->weight,
            'nationality' => $playerStats->nationality,
            'injured' => $playerStats->injured,
            'games_appearances' => $playerStats->games_appearances,
            'games_lineups' => $playerStats->games_lineups,
            'games_minutes' => $playerStats->games_minutes,
            'games_rating' => $playerStats->games_rating,
            'substitutes_in' => $playerStats->substitutes_in,
            'substitutes_out' => $playerStats->substitutes_out,
            'substitutes_bench' => $playerStats->substitutes_bench,
            'shots_total' => $playerStats->shots_total,
            'shots_on' => $playerStats->shots_on,
            'goals_total' => $playerStats->goals_total,
            'goals_conceded' => $playerStats->goals_conceded,
            'goals_assists' => $playerStats->goals_assists,
            'goals_saves' => $playerStats->goals_saves,
            'passes_total' => $playerStats->passes_total,
            'passes_key' => $playerStats->passes_key,
            'passes_accuracy' => $playerStats->passes_accuracy,
            'tackles_total' => $playerStats->tackles_total,
            'tackles_blocks' => $playerStats->tackles_blocks,
            'tackles_interceptions' => $playerStats->tackles_interceptions,
            'duels_total' => $playerStats->duels_total,
            'duels_won' => $playerStats->duels_won,
            'dribbles_attempts' => $playerStats->dribbles_attempts,
            'dribbles_success' => $playerStats->dribbles_success,
            'dribbles_past' => $playerStats->dribbles_past,
            'fouls_drawn' => $playerStats->fouls_drawn,
            'fouls_committed' => $playerStats->fouls_committed,
            'cards_yellow' => $playerStats->cards_yellow,
            'cards_yellowred' => $playerStats->cards_yellowred,
            'cards_red' => $playerStats->cards_red,
            'penalty_won' => $playerStats->penalty_won,
            'penalty_committed' => $playerStats->penalty_committed,
            'penalty_scored' => $playerStats->penalty_scored,
            'penalty_missed' => $playerStats->penalty_missed,
            'penalty_saved' => $playerStats->penalty_saved,
        ];

        // Prepare test data for the player
        $playerData = [
            'name' => $player->name,
            'age' => $player->age,
            'number' => $player->number,
            'position' => $player->position,
            'photo' => $player->photo,
            'playerStats' => $playerStatsData
        ];

        $response = $this->json('POST', 'http://localhost/api/player', $playerData);

        // Assertion: Ensure that the response has an HTTP status of 201 Created
        $response->assertStatus(201);

    }
}
