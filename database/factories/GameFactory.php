<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'referee' => fake()->name(),
            'stadium' => fake()->word(),
            'city' => fake()->city(),
            'date' => fake()->dateTime(),
            'home_team_name' => fake()->word(),
            'home_team_logo' => fake()->word(),
            'home_team_winner' => fake()->numberBetween([0], [1]),
            'away_team_name' => fake()->word(),
            'away_team_logo' => fake()->word(),
            'away_team_winner' => fake()->numberBetween([0], [1]),
            'league_name' => fake()->word(),
            'league_logo' => fake()->imageUrl(),
            'league_round' =>fake()->word(),
            'goals_home' =>fake()->randomNumber(),
            'goals_away' =>fake()->randomNumber(),
            'home_penalty' =>fake()->randomNumber(),
            'away_penalty' =>fake()->randomNumber(),
        ];
    }
}
