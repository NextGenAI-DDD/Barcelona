<?php

namespace Tests\Unit\Api;

use App\Models\TopAssist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class TopAssistTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Tworzenie kilku przykładowych rekordów TopAssist
        $topAssist1 = TopAssist::factory()->create();
        $topAssist2 = TopAssist::factory()->create();

        // Wywołanie akcji kontrolera
        $response = $this->get('http://localhost:8000/api/top-assist');

        // Sprawdzenie, czy status odpowiedzi to 200 (OK)
        $response->assertStatus(200);

        // Sprawdzenie, czy w odpowiedzi znajduje się JSON z danymi TopAssist
        $response->assertJson([
            'data' => [
                [
                    'player' => [
                        'id' => $topAssist1->id,
                        'name' => $topAssist1->name,
                        'photo' => $topAssist1->photo,
                        'games_appearences' => $topAssist1->games_appearences,
                        'games_minutes' => $topAssist1->games_minutes,
                        'games_position' => $topAssist1->games_position,
                        'goals_assists' => $topAssist1->goals_assists
                    ]
                ],
                [
                    'player' => [
                        'id' => $topAssist2->id,
                        'name' => $topAssist2->name,
                        'photo' => $topAssist2->photo,
                        'games_appearences' => $topAssist2->games_appearences,
                        'games_minutes' => $topAssist2->games_minutes,
                        'games_position' => $topAssist2->games_position,
                        'goals_assists' => $topAssist2->goals_assists
                    ]
                ]
            ]
        ]);
    }
}
