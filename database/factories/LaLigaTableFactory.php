<?php

namespace Database\Factories;

use App\Models\LaLigaTable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaLigaTable>
 */
class LaLigaTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = LaLigaTable::class;
    public function definition(): array
    {
        return [
        'rank' => fake()->unique()->randomNumber(2),
        'logo' => fake()->imageUrl(),
        'team' => fake()->unique()->word(),
        'match_played' => fake()->randomNumber(2),
        'win' => fake()->randomNumber(2),
        'draw' => fake()->randomNumber(2),
        'lose' => fake()->randomNumber(2),
        'goals_for' => fake()->randomNumber(3),
        'goals_against' => fake()->randomNumber(3),
        'goals_diff' => fake()->randomNumber(3),
        'points' => fake()->randomNumber(3),
        'form' => fake()->randomLetter(),
        ];
    }
}
