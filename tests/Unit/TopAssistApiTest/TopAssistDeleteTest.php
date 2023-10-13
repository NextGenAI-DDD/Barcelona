<?php

namespace Tests\Unit\TopAssistApiTest;

use App\Models\TopAssist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopAssistDeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function testDeletePlayer()
    {
        // Prepare test data for the player to be deleted
        $playerData = [
            'name' => 'Player to Delete',
            'photo' => 'delete.jpg',
            'games_appearances' => 10,
            'games_minutes' => 900,
            'games_position' => 'Defender',
            'goals_assists' => 2,
        ];

        // Create the player in the database
        $player = TopAssist::factory()->create($playerData);

        // Call the API endpoint to delete the player
        $response = $this->json('DELETE', "/api/top-assist/{$player->id}");

        // Assertion: Ensure the response has an HTTP status of 200 OK
        $response->assertStatus(200);

        // Assertion: Ensure the response contains a deletion message
        $response->assertJson(['message' => 'Team deleted']);

        // Assertion: Ensure the player no longer exists in the database after deletion
        $this->assertDatabaseMissing('top_assist', ['id' => $player->id]);
    }
}
