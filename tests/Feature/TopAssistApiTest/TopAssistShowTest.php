<?php


namespace Tests\Feature\TopAssistApiTest;

use App\Models\TopAssist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopAssistShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function testShowTopAssistsApi()
    {
        // Create
        $topAssist1 = TopAssist::factory()->create();
        $topAssist2 = TopAssist::factory()->create();


        // Get Controller Action
        $response = $this->json('GET', '/api/top-assist');

        // Search, response status 200 (OK)
        $response->assertStatus(200);

        // Search in response there are JSON with data TopAssist
        $response->assertExactJson([
            'data' => [
                [
                    'player' => [
                        'id' => $topAssist1->id,
                        'name' => $topAssist1->name,
                        'photo' => $topAssist1->photo,
                        'games_appearances' => $topAssist1->games_appearances,
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
                        'games_appearances' => $topAssist2->games_appearances,
                        'games_minutes' => $topAssist2->games_minutes,
                        'games_position' => $topAssist2->games_position,
                        'goals_assists' => $topAssist2->goals_assists
                    ]
                ]
            ]
        ]);
    }
}
