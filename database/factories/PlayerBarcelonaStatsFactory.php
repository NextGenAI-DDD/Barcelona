<?php

namespace Database\Factories;

use App\Models\PlayerBarcelonaStats;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlayerBarcelonaStats>
 */
class PlayerBarcelonaStatsFactory extends Factory
{

    protected $model = PlayerBarcelonaStats::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'player_id' => fake()->numberBetween(1,10),
            'birth_date' => fake()->date(),
            'height' => fake()->numberBetween(160, 200),
            'weight' => fake()->numberBetween(50, 100),
            'nationality' => fake()->country(),
            'injured' => fake()->boolean(),
            'games_appearances' => fake()->numberBetween(0, 50),
            'games_lineups' => fake()->numberBetween(0, 50),
            'games_minutes' => fake()->numberBetween(0, 4500),
            'games_rating' => fake()->randomFloat(1, 0, 10),
            'substitutes_in' => fake()->numberBetween(0, 50),
            'substitutes_out' => fake()->numberBetween(0, 50),
            'substitutes_bench' => fake()->numberBetween(0, 50),
            'shots_total' => fake()->numberBetween(0, 100),
            'shots_on' => fake()->numberBetween(0, 100),
            'goals_total' => fake()->numberBetween(0, 30),
            'goals_conceded' => fake()->numberBetween(0, 30),
            'goals_assists' => fake()->numberBetween(0, 30),
            'goals_saves' => fake()->numberBetween(0, 30),
            'passes_total' => fake()->numberBetween(0, 5000),
            'passes_key' => fake()->numberBetween(0, 500),
            'passes_accuracy' => fake()->randomFloat(2, 40, 100),
            'tackles_total' => fake()->numberBetween(0, 200),
            'tackles_blocks' => fake()->numberBetween(0, 20),
            'tackles_interceptions' => fake()->numberBetween(0, 50),
            'duels_total' => fake()->numberBetween(0, 200),
            'duels_won' => fake()->numberBetween(0, 200),
            'dribbles_attempts' => fake()->numberBetween(0, 100),
            'dribbles_success' => fake()->numberBetween(0, 100),
            'dribbles_past' => fake()->numberBetween(0, 100),
            'fouls_drawn' => fake()->numberBetween(0, 50),
            'fouls_committed' => fake()->numberBetween(0, 50),
            'cards_yellow' => fake()->numberBetween(0, 10),
            'cards_yellowred' => fake()->numberBetween(0, 5),
            'cards_red' => fake()->numberBetween(0, 2),
            'penalty_won' => fake()->numberBetween(0, 10),
            'penalty_committed' => fake()->numberBetween(0, 10),
            'penalty_scored' => fake()->numberBetween(0, 10),
            'penalty_missed' => fake()->numberBetween(0, 10),
            'penalty_saved' => fake()->numberBetween(0, 10),
        ];
    }
}
