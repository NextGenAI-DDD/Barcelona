<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class addRecordsToTopAssistTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-records-to-top-assist-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Added records to top assist table from Api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $client = new Client();

            $response = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/players/topassists?league=140&season=2023', [
                'headers' => [
                    'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'b918db7937msh635c1bfaeff0577p1e7a14jsn98d8e96cd7ec',
                ],
            ]);

            // GET data from API response
            $data = json_decode($response->getBody(), true);

            $topAssists = $data['response'];

            $requestData = [];
            // Foreach for send data to table top_assist
            foreach ($topAssists as $topAssist){
                $statistics = $topAssist['statistics'][0];

                $requestData[] = [
                    'name' => $topAssist['player']['name'],
                    'photo' => $topAssist['player']['photo'],
                    'games_appearances' => $statistics['games']['appearences'],
                    'games_minutes' => $statistics['games']['minutes'],
                    'games_position' => $statistics['games']['position'],
                    'goals_assists' => $statistics['goals']['assists'],
                    'club_name' => $statistics['team']['name'],
                    'club_logo' => $statistics['team']['logo']
                ];
            }
            $jsonRequest = json_encode($requestData);

            $apiResponse = $client->request('POST', 'http://localhost/api/top-assist', [
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
