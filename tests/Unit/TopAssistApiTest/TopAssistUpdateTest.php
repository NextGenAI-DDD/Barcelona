<?php

namespace Tests\Unit\TopAssistApiTest;

use App\Models\TopAssist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopAssistUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function testUpdatePlayer()
    {
        // Przygotowanie danych testowych dla istniejącego zawodnika
        $existingPlayerData = [
            'name' => 'Existing Player',
            'photo' => 'existing.jpg', // Dodaj brakujące dane
            'games_appearances' => 15, // Dodaj brakujące dane
            'games_minutes' => 1200, // Dodaj brakujące dane
            'games_position' => 'Midfielder', // Dodaj brakujące dane
            'goals_assists' => 3, // Dodaj brakujące dane
        ];

        // Utwórz istniejącego zawodnika w bazie danych
        $existingPlayer = TopAssist::factory()->create($existingPlayerData);

        // Przygotuj dane aktualizacji
        $updateData = [
            'name' => 'Updated Player',
            'photo' => 'updated.jpg', // Dodaj brakujące dane
            'games_appearances' => 20, // Dodaj brakujące dane
            'games_minutes' => 1800, // Dodaj brakujące dane
            'games_position' => 'Forward', // Dodaj brakujące dane
            'goals_assists' => 6, // Dodaj brakujące dane
        ];

        // Wywołaj endpoint API do aktualizacji zawodnika
        $response = $this->json('PUT', "/api/top-assist/{$existingPlayer->id}", $updateData);

        // Assertion: Ensure the response has an HTTP status of 200 OK
        $response->assertStatus(200);

        // Assertion: Ensure the response contains the updated data
        $response->assertJson([
            'data' => [
                'player' => [
                    'name' => $updateData['name'],
                    'photo' => $updateData['photo'],
                    'games_appearances' => $updateData['games_appearances'],
                    'games_minutes' => $updateData['games_minutes'],
                    'games_position' => $updateData['games_position'],
                    'goals_assists' => $updateData['goals_assists'],
                ],
            ],
        ]);
    }
}
