<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class addRecordsToLaLigaTable extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-records-to-la-liga-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add records to table la-liga-table';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
        // Create Guzzle HTTP Client
        $client = new Client();

        // Execute request to API
        $response = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/standings?season=2024&league=140', [
            'headers' => [
                'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
                'X-RapidAPI-Key' => 'b918db7937msh635c1bfaeff0577p1e7a14jsn98d8e96cd7ec',
            ],
        ]);

        // GET data from API response
        $data = json_decode($response->getBody(), true);

        $league = $data['response'][0]['league'];

        $standings = $league['standings'][0];

        $requestData = [];
            foreach ($standings as $item) {
                $requestData[] = [
                    'rank' => $item['rank'],
                    'logo' => $item['team']['logo'],
                    'team' => $item['team']['name'],
                    'match_played' => $item['all']['played'],
                    'win' => $item['all']['win'],
                    'draw' => $item['all']['draw'],
                    'lose' => $item['all']['lose'],
                    'goals_for' => $item['all']['goals']['for'],
                    'goals_against' => $item['all']['goals']['against'],
                    'goals_diff' => $item['goalsDiff'],
                    'points' => $item['points'],
                    'form' => $item['form']
                ];
            }

            $jsonRequest = json_encode($requestData);

            $apiResponse = $client->request('POST', 'http://localhost/api/laLigaTable', [
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
