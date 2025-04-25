<?php

namespace Tests\Feature\TopScoreApiTest;

use App\Models\TopScore;
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
        $data = [];
        $players = TopScore::factory()->count(2)->make();
        // Data to be sent in the POST request

        foreach ($players as $player) {
            $data[] = [
                'name' => $player->name,
                'photo' => $player->photo,
                'games_appearances' => $player->games_appearances,
                'games_minutes' => $player->games_minutes,
                'games_position' => $player->games_position,
                'goals' => $player->goals,
                'club_name' => $player->club_name,
                'club_logo' => $player->club_logo
            ];
        }

        $dataResponse = [];

        foreach ($players as $key=>$player) {
            $dataResponse[] = [
                'player' => [
                    'id' => $key+3, // You might want to adjust this based on your actual logic
                    'name' => $player->name,
                    'photo' => $player->photo,
                    'games_appearances' => $player->games_appearances,
                    'games_minutes' => $player->games_minutes,
                    'games_position' => $player->games_position,
                    'goals' => $player->goals,
                    'club_name' => $player->club_name,
                    'club_logo' => $player->club_logo
                ]
            ];
        }

        // Execute the POST request
        $response = $this->json('POST', '/api/top-score', $data);

        // Check if the response has a 200 status (you may adjust this to the actual HTTP response status)
        $response->assertStatus(200);

        // Get the decoded JSON content from the response
        $responseContent = $response->decodeResponseJson();

        // Check if the response data matches the expected structure
        $this->assertEquals($dataResponse, $responseContent['data']);
    }
}
