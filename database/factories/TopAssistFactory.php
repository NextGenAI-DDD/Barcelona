<?php

namespace Database\Factories;

use App\Models\TopAssist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TopAssist>
 */
class TopAssistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TopAssist::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'photo' => fake()->imageUrl(),
            'games_appearances' => fake()->randomNumber(2),
            'games_minutes' => fake()->randomNumber(3),
            'games_position' => fake()->word,
            'goals_assists' => fake()->randomNumber(2),
            'club_name' => fake()->word(),
            'club_logo' => fake()->imageUrl(),
        ];
    }
}
