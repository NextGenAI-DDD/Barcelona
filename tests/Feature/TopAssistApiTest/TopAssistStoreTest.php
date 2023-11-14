<?php

namespace Tests\Feature\TopAssistApiTest;

use App\Models\TopAssist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopAssistStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test for TopAssistApi Store
     */
    public function testStoreTopAssistApi(): void
    {
        $data = [];
        $players = TopAssist::factory()->count(2)->make();
        // Data to be sent in the POST request

        foreach ($players as $player) {
            $data[] = [
                'name' => $player->name,
                'photo' => $player->photo,
                'games_appearances' => $player->games_appearances,
                'games_minutes' => $player->games_minutes,
                'games_position' => $player->games_position,
                'goals_assists' => $player->goals_assists,
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
                    'goals_assists' => $player->goals_assists,
                ]
            ];
        }

        // Execute the POST request
        $response = $this->json('POST', '/api/top-assist', $data);

        // Check if the response has a 200 status (you may adjust this to the actual HTTP response status)
        $response->assertStatus(200);

        // Get the decoded JSON content from the response
        $responseContent = $response->decodeResponseJson();

        // Check if the response data matches the expected structure
        $this->assertEquals($dataResponse, $responseContent['data']);
    }
}
