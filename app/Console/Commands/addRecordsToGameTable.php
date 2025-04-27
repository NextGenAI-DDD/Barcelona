<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddRecordsToGameTable extends Command
{
    protected $signature = 'app:add-records-to-game-table';
    protected $description = 'Add records to table game';

    private Client $clientl;
    private string $apiUrl;
    private string $apiHost;
    private string $apiKey;
    private string $localApiUrl;

    public function __construct()
    {   
        parent::__construct();
        $this->client = new Client();
        $this->apiUrl = env('FOOTBALL_API_URL');
        $this->apiHost = env('FOOTBALL_API_HOST');
        $this->apiKey = env('FOOTBALL_API_KEY');
        $this->localApiUrl = env('LOCAL_API_GAME_URL');
    } 


    public function handle(): void
    {
        try {
            $games = $this->fetchGames();
            $this->sendGames($games);

            $this->info('Games added succesfully.');
        } catch (\Exception $e) {
            Log::error('Error while adding records: ' . $e->getMessage());
            $this->error('An error occured while adding records.');
        }
    }

    private function fetchGames(): array
    {

        $response = $this->client->request('Get', $this->apiUrl, [
                'headers' => [
                    'X-RapidAPI-Host' => $this->apiHost,
                    'X-RapidAPI-Key' => $this->apiKey,
                ],
            ]);


            
            $data = json_decode($response->getBody()->getContents(), true);

            return array_map([$this, 'transormGame'], $data['response']);
        }

        private function sendGames(array $games): void
        {
            $this->client->request('Post', $this->localApiUrl, [
                'json' => $games,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]); 
        }

        private function transformGame(array $game): array
        {
            return [


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
                    'home_penalty' => $game['score']['penalty']['home'] ?? 0,
                    'away_penalty' => $game['score']['penalty']['away'] ?? 0,
                ];
        }

}
    