<?php

declare(strict_types=1);

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class AddRecordsToTopAssistTable extends Command
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

     public function __consturct(
        private readonly Client $client,
        private ?int $season = null,
    ) {
        parent::__consturct();
        $this->season ??= (int) date('Y') - 1;
    }

    public function handle(): void
    {
       $this->info(sprintf('Pobieranie danych najlepszych asystujących dla sezonu %d...', $this->season));

        try {
             $topAssists = $this->getTopAssists();

             $this->info(sprintf('Znaleziono %d zawodników.', count($topAssists)));

             $this->sendTopAssists($topAssists);

             $this->info('Import danych asyst zakończony!');
        }   catch (\Exception $e) {
             $this->error('Wystąpił błąd: ' . $e->getMessage());
               Log::error('Błąd podczas importu asyst: ' . $e->getMessage());
        }
    }
       
    private function getTopAssists(): array
    {
        $url = sprintf(
            'https://api-football-v1.p.rapidapi.com/v3/players/topassists?league=140&season=%d',
            $this->season 
        );

        $response = $this->makeApiRequest($url);

        return $response['response'] ?? [];
    }

    private function makeApiRequest(string $url): array
    {
        try{
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'X-RapidAPI-Host' => env('API_KEY_HOST_FOR_API_FOOTBALL'),
                    'X-RapidAPI_Key' => env('AUTHORIZATION_KEY_FOT_API_FOOTBALL'),
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (GuzzleException $e) {
            throw new \RuntimeException('API request failed: ' . $e->getMessage());
        }
    } 
            
    private function sendTopAssists(array $topAssists): void 
    {
        $formattedData = array_map(function (array $item) {
            $stats = $item['statistics'][0];
        
                return [    
                    'name' => $topAssist['player']['name'],
                    'photo' => $topAssist['player']['photo'],
                    'games_appearances' => $statistics['games']['appearences'],
                    'games_minutes' => $statistics['games']['minutes'],
                    'games_position' => $statistics['games']['position'],
                    'goals_assists' => $statistics['goals']['assists'],
                    'club_name' => $statistics['team']['name'],
                    'club_logo' => $statistics['team']['logo']
                ];
            }, $topAssists);

            try {
                $this->client->request('POST', env('APP_URL') . '/api/top-assist', [
                    'body' => json_encode($formattedData),
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                ]);
            } catch (GuzzleException $e) {
                throw new \RuntimeException(
                    'Failed to send top assists request: ' . $e->getMessage()

            }
      }
}
