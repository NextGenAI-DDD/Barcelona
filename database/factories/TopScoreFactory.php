<?php

namespace Database\Factories;

use App\Models\TopScore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TopScore>
 */
class TopScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TopScore::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'photo' => fake()->imageUrl(),
            'games_appearances' => fake()->randomNumber(2),
            'games_minutes' => fake()->randomNumber(3),
            'games_position' => fake()->word,
            'goals' => fake()->randomNumber(2),
            'club_name' => fake()->word(),
            'club_logo' => fake()->imageUrl()
        ];
    }
}
