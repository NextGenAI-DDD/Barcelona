<?php

declare(strict_types=1);

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class AddRecordsToLaLigaTable extends Command
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

    public function __construct(
        private readonly Client $client,
        private ?int $season = null,
    ) {
        parent::__construct();

        $year = (int) date('Y');
        $month = (int) date('n'); 
    
        $this->season ??= $month >= 8 ? $year : $year - 1;
    }

    /**
     * Execute the console command.
     */
    public function handle():void
    {
        $this->info('Pobieranie danych tabeli La Liga...');

        try {
            $standings = $this->getStandings();

            $this->info(sprintf('Znaleziono %d drużyn.', count($standings)));

            $this->sendStandings($standings);

            $this->info('Import tabeli La Liga zakończony!');
        } catch (\Exception $e) {
            $this->error('Wystąpił błąd: ' . $e->getMessage());
            Log::error('Błąd podczas importu tabeli La Liga: ' . $e->getMessage());
        }
    }

    private function getStandings(): array
    {
        $url = sprintf(
            'https://api-football-v1.p.rapidapi.com/v3/standings?season=%d%league=140'
             $this->season 
        );

        $response = $this->makeApiRequest($url);

        return $response['response'][0]['league']['standings'][0] ?? [];
    }

    private function makeApiRequest(string $url): array
    {
        try {
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'X-RapidApi-Host' => env('API_KEY_HOST_FOR_API_FOOTBALL'),
                    'X-RapidApi-Key' => env('AUTHORIZATION_KEY_FOR_API_FOOTBALL'),
                ]
                ]);

                return json_decode((string)$response->getBody(), true);
            } catch (GuzzleException $e) {
                throw new \RuntimeException('API request failed: ' . $e->getMessage());
            }
        }
    }
        
    private function sendStandings(array $standings): void
    {
        $formattedData = array_map(fn(array $item) => [
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
        ], $standings);
            
        try {
            $this->client->request('POST', env('APP_URL') . '/api/laLigaTable', [
                'body' => json_encode($formattedData),
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
        } catch (GuzzleException $e) {
            throw new \RuntimeException('Failed to send standings: ' . $e->getMessage());

        }
    }
 
