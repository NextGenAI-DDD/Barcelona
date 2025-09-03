<?php

declare(strict_types=1);

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class AddRecordsToTopScoreTable extends Command
{
    private const LEAGUE_ID = 140;
    /**
     * The name and signature of the console command.
     */
    protected string $signature = 'app:add-records-to-top-score-table';

    /**
     * The console command description.
     */
    protected string $description = 'Added records to top score table from Api';

    /**
     * Execute the console command.
     */

    public function __construct(
         private readonly Client $client,
         private readonly int $season = 0,
     ) {
        parent::__construct();
        $this->season = $this->season ?: (int) date('Y') - 1;
    }

    public function handle(): void
    {
        $this->info('Pobieranie danych o najlepszych strzelcach...');

        try {
            $scorers = $this->getTopScorers();
            $this->info(sprintf('Znaleziono %d zawodników', count($scorers)));

            $this->processTopScorers($scorers);

            $this->info('Import zakończony.');
        } catch (\Exception $e) {
            $this->error('Błąd:' . $e->getMessage());
            Log::error('Błąd przy pobieraniu najlepszych strzelców: ' . $e->getMessage());
        }
    }

    private function getTopScorers(): array
    {
        $response = $this->makeApiRequest(
            'https://api-football-v1.p.rapidapi.com/v3/players/topscorers',
            ['query' => [
                'league' => self::LEAGUE_ID,
                'season' => $this->season,
            ],
            ]
        );

        return $response['response'] ?? [];
    }

    private function makeApiRequest(string $url, array $options = []): array
    {
        $options['headers'] = [
            'X-RapidAPI-Host' => env('API_KEY_HOST_FOR_API_FOOTBALL'),
            'X-RapidAPI-Key' => env('AUTHORIZATION_KEY_FOR_API_FOOTBALL'),
        ];

        $response = $this->client->request('GET', $url, $options);
        return json_decode((string) $response->getBody(), true);
    }

    private function processTopScorers(array $players): void
    {
        $requestData = [];

        foreach ($players as $player) {
            try {
                $requestData[] = $this->formatPlayer($player);
            } catch (\Exception $e) {
                $this->warn('Błąd przy przetwarzaniu gracza: ' . $e->getMessage());
            }
        }

        $this->sendToApi($requestData);
    }

    private function formatPlayer(array $player): array
    {
        $stats = $player['statistics'][0];

        return [
            'name' => $topAssist['player']['name'],
            'photo' => $topAssist['player']['photo'],
            'games_appearances' => $statistics['games']['appearences'],
            'games_minutes' => $statistics['games']['minutes'],
            'games_position' => $statistics['games']['position'],
            'goals' => $statistics['goals']['total'],
            'club_name' => $statistics['team']['name'],
            'club_logo' => $statistics['team']['logo'],
        ];
    }

    private function sendToApi(array $requestData): void
    {
        try {
            $this->client->request('POST', env('APP_URL') . '/api/top-score', [
                'body' => json_encode($requestData),
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
        } catch (\Exception $e) {
            $this->warn('Błąd przy wysyłaniu danych: ' . $e->getMessage());
            Log::error('Błąd przy wysyłaniu danych top-score: ' . $e->getMessage());
        }
    }
}
