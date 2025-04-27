<?php

declare(strict_types=1);

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class addRecordsToGameTable extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected string $signature = 'app:add-records-to-game-table';

    /**
     * The console command description.
     */
    protected string $description = 'Add records to table game';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            // Create Guzzle HTTP Client
            $client = new Client();

            // Execute request to API
            $response = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/fixtures?season=2024&team=529', [
                'headers' => [
                    'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'b918db7937msh635c1bfaeff0577p1e7a14jsn98d8e96cd7ec',
                ],
            ]);

            // GET data from API response
            $data = json_decode($response->getBody(), true);

            $games = $data['response'];

            $requestData = [];

            foreach ($games as $game) {
                $requestData[] = [
                    'referee' => $game['fixture']['referee'],
                    'stadium' => $game['fixture']['venue']['name'],
                    'city' => $game['fixture']['venue']['city'],
                    'date' => $game['fixture']['date'],
                    'home_team_name' => $game['teams']['home']['name'],
                    'home_team_logo' => $game['teams']['home']['logo'],
                    'home_team_winner' => $game['teams']['home']['winner'],
                    'away_team_name' => $game['teams']['away']['name'],
                    'away_team_logo' => $game['teams']['away']['logo'],
                    'away_team_winner' => $game['teams']['away']['winner'],
                    'league_name' => $game['league']['name'],
                    'league_logo' => $game['league']['logo'],
                    'league_round' => $game['league']['round'],
                    'goals_home' => $game['goals']['home'],
                    'goals_away' => $game['goals']['away'],
                    'home_penalty' => $game['score']['penalty']['home'] === null ? 0 : $game['score']['penalty']['home'],
                    'away_penalty' => $game['score']['penalty']['away'] === null ? 0 : $game['score']['penalty']['away'],
                ];
            }

            $jsonRequest = json_encode($requestData);

            $apiResponse = $client->request('POST', 'http://localhost/api/game', [
                'body' => $jsonRequest,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            $apiResponseData = $apiResponse->getBody();

            $this->info($apiResponseData);
        } catch (\Exception $e) {
            // Logowanie błędu
            Log::error('Error while adding records: ' . $e->getMessage());
        }
    }
}
