<?php


namespace Tests\Feature\TopScoreApiTest;

use App\Models\TopScore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopScoreShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for TopScoreShow Api
     */
    public function testShowTopScoreApi()
    {
        // Create
        $topAssist1 = TopScore::factory()->create();
        $topAssist2 = TopScore::factory()->create();


        // Get Controller Action
        $response = $this->json('GET', '/api/top-score');

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
                        'goals' => $topAssist1->goals,
                        'club_name' => $topAssist1->club_name,
                        'club_logo' => $topAssist1->club_logo
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
                        'goals' => $topAssist2->goals,
                        'club_name' => $topAssist2->club_name,
                        'club_logo' => $topAssist2->club_logo
                    ]
                ]
            ]
        ]);
    }
}
