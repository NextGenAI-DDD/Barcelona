<?php

namespace Tests\Unit\Player;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Player;
use App\Models\PlayerBarcelonaStats;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PlayerApiTest extends TestCase
{
    use RefreshDatabase;

    public function testStorePlayerWithStats()
    {
        // Create Table for 5 players
        $playersData = [];
        for ($i = 0; $i < 5; $i++) {
            $playerData = Player::factory()->make()->toArray();
            $statsData = PlayerBarcelonaStats::factory()->make()->toArray();

            $playersData[] = [
                'name' => $playerData['name'],
                'age' => $playerData['age'],
                'number' => $playerData['number'],
                'position' => $playerData['position'],
                'photo' => $playerData['photo'],
                'playerStats' => $statsData,
            ];
        }

        $data = ['players' => $playersData];

        $response = $this->json('POST', '/api/player', $data);

        $response->assertStatus(200);
        $response->assertSee("Players Added");
    }
}
