<?php

namespace Tests\Unit\TopAssistApiTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class TopAssistStoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function testStoreTopAssistApi(): void
    {
        // Dane do przesłania w zapytaniu POST
        $data = [
            "name" => "John Doe",
            "photo" => "aaaaaaaaaa",
            "goals" => 10,
            "games_appearances" => 20,
            "games_minutes" => 1800,
            "games_position" => "Forward",
            "goals_assists" => 5,
        ];

        $data = json_encode($data);

        // Wykonaj zapytanie POST
        $response = $this->post('/api/top-assist', $data);

        // Sprawdź, czy odpowiedź ma kod 201 (utworzono) - możesz dostosować ten kod do rzeczywistego statusu odpowiedzi HTTP
        $response->assertStatus(201);

        // Możesz dodać dodatkowe asercje, aby sprawdzić zawartość odpowiedzi JSON itp.
        $response->assertExactJson([
            'data' => [
                'player' => [
                    "name" => "John Doe",
                    "photo" => "aaaaaaaaaa",
                    "goals" => 10,
                    "games_appearances" => 20,
                    "games_minutes" => 1800,
                    "games_position" => "Forward",
                    "goals_assists" => 5,
                    ]
                ]
        ]);
    }
}
