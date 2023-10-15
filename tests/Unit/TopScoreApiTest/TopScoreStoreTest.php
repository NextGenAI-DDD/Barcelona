<?php

namespace Tests\Unit\TopScoreApiTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopScoreStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function testStoreTopScoreApi()
    {
        // Prepare test data for the first player
        $player1Data = [
            'name' => 'Test Player 1',
            'photo' => 'test1.jpg',
            'goals' => 10,
            'games_appearances' => 20,
            'games_minutes' => 1800,
            'games_position' => 'Forward',
        ];

        // Prepare test data for the second player
        $player2Data = [
            'name' => 'Test Player 2',
            'photo' => 'test2.jpg',
            'goals' => 8,
            'games_appearances' => 18,
            'games_minutes' => 1600,
            'games_position' => 'Midfielder',
        ];

        // Iterate through different players
        foreach ([$player1Data, $player2Data] as $data) {
            // Call the API endpoint for each player
            $response = $this->json('POST', '/api/top-score', $data);

            // Assertion: Ensure that the response has an HTTP status of 201 Created
            $response->assertStatus(201);

            // Assertion: Ensure that the response contains the expected data
            $response->assertJson([
                'data' => [
                    'player' => [
                        'name' => $data['name'],
                        'photo' => $data['photo'],
                        'games_appearances' => $data['games_appearances'],
                        'games_minutes' => $data['games_minutes'],
                        'games_position' => $data['games_position'],
                        'goals' => $data['goals'],
                    ],
                ],
            ]);
        }
    }
}

