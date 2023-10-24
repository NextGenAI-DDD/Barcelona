<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class addRecordsToPlayerTableAndPlayersStatsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-records-to-player-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Added records to player table and player stats table from Api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/players/squads?team=529', [
                'headers' => [
                    'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'b918db7937msh635c1bfaeff0577p1e7a14jsn98d8e96cd7ec',
                ],
            ]);

            // GET data from API response
            $data = json_decode($response->getBody(), true);

            $players = $data['response'][0]['players'];

            $playersData = [];

            // Foreach for send data to table top_assist
            foreach ($players as $player) {
                $playerStats = [];

                // Api for get player stats
                $responseStats = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/players?id='.$player['id'].'&season=2023', [
                    'headers' => [
                        'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
                        'X-RapidAPI-Key' => 'b918db7937msh635c1bfaeff0577p1e7a14jsn98d8e96cd7ec',
                    ],
                ]);

                // GET data from API response
                $dataStats = json_decode($responseStats->getBody(), true);

                if($dataStats != null){
                    $stats = $dataStats['response'][0];

                    $statsPlayer = $stats['player'];

                    $statsStatistics = $stats['statistics'][0];

                    // Added player stats
                    $playerStats = [
                        'birth_date' => $statsPlayer['birth']['date'],
                        'height' => $statsPlayer['height'],
                        'weight' => $statsPlayer['weight'],
                        'nationality' => $statsPlayer['nationality'],
                        'injured' => $statsPlayer['injured'],
                        'games_appearances' => $statsStatistics['games']['appearences'],
                        'games_lineups' => $statsStatistics['games']['lineups'],
                        'games_minutes' => $statsStatistics['games']['minutes'],
                        'games_rating' => $statsStatistics['games']['rating'],
                        'substitutes_in' => $statsStatistics['substitutes']['in'],
                        'substitutes_out' => $statsStatistics['substitutes']['out'],
                        'substitutes_bench' => $statsStatistics['substitutes']['bench'],
                        'shots_total' => $statsStatistics['shots']['total'],
                        'shots_on' => $statsStatistics['shots']['on'],
                        'goals_total' => $statsStatistics['goals']['total'],
                        'goals_conceded' => $statsStatistics['goals']['conceded'],
                        'goals_assists' => $statsStatistics['goals']['assists'],
                        'goals_saves' => $statsStatistics['goals']['saves'],
                        'passes_total' => $statsStatistics['passes']['total'],
                        'passes_key' => $statsStatistics['passes']['key'],
                        'passes_accuracy' => $statsStatistics['passes']['accuracy'],
                        'tackles_total' => $statsStatistics['tackles']['total'],
                        'tackles_blocks' => $statsStatistics['tackles']['blocks'],
                        'tackles_interceptions' => $statsStatistics['tackles']['interceptions'],
                        'duels_total' => $statsStatistics['duels']['total'],
                        'duels_won' => $statsStatistics['duels']['won'],
                        'dribbles_attempts' => $statsStatistics['dribbles']['attempts'],
                        'dribbles_success' => $statsStatistics['dribbles']['success'],
                        'dribbles_past' => $statsStatistics['dribbles']['past'],
                        'fouls_drawn' => $statsStatistics['fouls']['drawn'],
                        'fouls_committed' => $statsStatistics['fouls']['committed'],
                        'cards_yellow' => $statsStatistics['cards']['yellow'],
                        'cards_yellowred' => $statsStatistics['cards']['yellowred'],
                        'cards_red' => $statsStatistics['cards']['red'],
                        'penalty_won' => $statsStatistics['penalty']['won'],
                        'penalty_committed' => $statsStatistics['penalty']['commited'],
                        'penalty_scored' => $statsStatistics['penalty']['scored'],
                        'penalty_missed' => $statsStatistics['penalty']['missed'],
                        'penalty_saved' => $statsStatistics['penalty']['saved'],
                    ];
                }

                // Added player with stats
                $playersData[] = [
                    'name' => $player['name'],
                    'age' => $player['age'],
                    'number' => $player['number'],
                    'position' => $player['position'],
                    'photo' => $player['photo'],
                    'playerStats' => $playerStats
                ];

                //sleep foreach beacuse to many request on 5 seconds
                sleep(5);
            }

            $requestData = [
                'players' => $playersData,
            ];

            $jsonRequest = json_encode($requestData);

            $apiResponse = $client->request('POST', 'http://localhost/api/player', [
                'body' => $jsonRequest,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            $apiResponseData = $apiResponse->getBody();

            $this->info($apiResponseData);
        }catch (\Exception $e) {
            // Logowanie błędu
            Log::error('Error while adding records: ' . $e->getMessage());
        }

    }
}
