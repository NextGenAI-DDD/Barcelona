<?php

namespace GameApiTest;

use App\Models\Game;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameApiTest extends TestCase
{
    public function testIndex()
    {
        // Seed the database with some sample games
        // Create
        $game1 = Game::factory()->create();
        $game2 = Game::factory()->create();


        $response = $this->getJson('/api/game');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');

        // Search in response there are JSON with data TopAssist
        $response->assertExactJson([
            'data' => [
                [
                    'game' => [
                        'id' => $game1->id,
                        'referee' => $game1->referee,
                        'stadium' => $game1->stadium,
                        'city' => $game1->city,
                        'date' => $game1->date->format('Y-m-d H:i:s'),
                        'home_team_name' => $game1->home_team_name,
                        'home_team_logo' => $game1->home_team_logo,
                        'home_team_winner' => $game1->home_team_winner,
                        'away_team_name' => $game1->away_team_name,
                        'away_team_logo' => $game1->away_team_logo,
                        'away_team_winner' => $game1->away_team_winner,
                        'league_name' => $game1->league_name,
                        'league_logo' => $game1->league_logo,
                        'league_round' => $game1->league_round,
                        'goals_home' => $game1->goals_home,
                        'goals_away' => $game1->goals_away,
                        'home_penalty' => $game1->home_penalty,
                        'away_penalty' => $game1->away_penalty,
                    ]
                ],
                [
                    'game' => [
                        'id' => $game2->id,
                        'referee' => $game2->referee,
                        'stadium' => $game2->stadium,
                        'city' => $game2->city,
                        'date' => $game2->date->format('Y-m-d H:i:s'),
                        'home_team_name' => $game2->home_team_name,
                        'home_team_logo' => $game2->home_team_logo,
                        'home_team_winner' => $game2->home_team_winner,
                        'away_team_name' => $game2->away_team_name,
                        'away_team_logo' => $game2->away_team_logo,
                        'away_team_winner' => $game2->away_team_winner,
                        'league_name' => $game2->league_name,
                        'league_logo' => $game2->league_logo,
                        'league_round' => $game2->league_round,
                        'goals_home' => $game2->goals_home,
                        'goals_away' => $game2->goals_away,
                        'home_penalty' => $game2->home_penalty,
                        'away_penalty' => $game2->away_penalty,
                    ]
                ]
            ]
        ]);
    }

    public function testStore()
    {
        $data = [];
        $games = Game::factory(2)->make();
        // Data to be sent in the POST request

        foreach ($games as $game) {
            $data[] = [
                'referee' => $game->referee,
                'stadium' => $game->stadium,
                'city' => $game->city,
                'date' => $game->date->format('Y-m-d H:i:s'),
                'home_team_name' => $game->home_team_name,
                'home_team_logo' => $game->home_team_logo,
                'home_team_winner' => $game->home_team_winner,
                'away_team_name' => $game->away_team_name,
                'away_team_logo' => $game->away_team_logo,
                'away_team_winner' => $game->away_team_winner,
                'league_name' => $game->league_name,
                'league_logo' => $game->league_logo,
                'league_round' => $game->league_round,
                'goals_home' => $game->goals_home,
                'goals_away' => $game->goals_away,
                'home_penalty' => $game->home_penalty,
                'away_penalty' => $game->away_penalty,
            ];
        }

        $dataResponse = [];

        foreach ($games as $key=>$game) {
            $dataResponse[] = [
                'game' => [
                    'id' => $key+3, // You might want to adjust this based on your actual logic
                    'referee' => $game->referee,
                    'stadium' => $game->stadium,
                    'city' => $game->city,
                    'date' => $game->date->format('Y-m-d H:i:s'),
                    'home_team_name' => $game->home_team_name,
                    'home_team_logo' => $game->home_team_logo,
                    'home_team_winner' => $game->home_team_winner,
                    'away_team_name' => $game->away_team_name,
                    'away_team_logo' => $game->away_team_logo,
                    'away_team_winner' => $game->away_team_winner,
                    'league_name' => $game->league_name,
                    'league_logo' => $game->league_logo,
                    'league_round' => $game->league_round,
                    'goals_home' => $game->goals_home,
                    'goals_away' => $game->goals_away,
                    'home_penalty' => $game->home_penalty,
                    'away_penalty' => $game->away_penalty
                ]
            ];
        }

        // Execute the POST request
        $response = $this->json('POST', '/api/game', $data);

        // Check if the response has a 200 status (you may adjust this to the actual HTTP response status)
        $response->assertStatus(200);

        // Get the decoded JSON content from the response
        $responseContent = $response->decodeResponseJson();

        // Check if the response data matches the expected structure
        $this->assertEquals($dataResponse, $responseContent['data']);
    }


}
