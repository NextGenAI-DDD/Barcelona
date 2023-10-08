<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TopAssist;

class TopAssistFactory extends Factory
{
    protected $model = TopAssist::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'photo' => $this->faker->imageUrl(),
            'games_appearences' => $this->faker->randomNumber(2),
            'games_minutes' => $this->faker->randomNumber(3),
            'games_position' => $this->faker->word,
            'goals_assists' => $this->faker->randomNumber(2),
        ];
    }
}

