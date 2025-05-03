<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class addRecordsToGameTable extends Command
{
    private const TEAM_ID = 529;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-records-to-game-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add records to table game';

    public function __construct(
        private readonly Client $client,
        private ?int $season,
    ) {
        parent::__construct();
        $this->season = (int) date('Y') - 1;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Pobieranie danych spotkań...');

        try {
            $games = $this->getGames();
            $this->info(sprintf('Znaleziono %d spotkania', count($games)));

            $this->processGames($games);

            $this->info('Import danych spotkań zakończony!');
        } catch (\Exception $e) {
            $this->error('Wystąpił błąd: ' . $e->getMessage());
            Log::error('Błąd podczas importu danych spotkania: ' . $e->getMessage());
        }
    }

    /**
     * Get team squad data
     *
     * @throws GuzzleException
     */
    private function getGames(): array
    {
        $response = $this->makeApiRequest(
            'https://api-football-v1.p.rapidapi.com/v3/fixtures',
            ['query' => [
                'team' => self::TEAM_ID,
                'season' => $this->season
                ]]
        );

        return $response['response'] ?? [];
    }

    /**
     * Make API request
     *
     * @throws GuzzleException
     */
    private function makeApiRequest(string $url, array $options = []): array
    {
        $options['headers'] = [
            'X-RapidAPI-Host' => env('API_KEY_HOST_FOR_API_FOOTBALL'),
            'X-RapidAPI-Key' => env('AUTHORIZATION_KEY_FOR_API_FOOTBALL'),
        ];

        $response = $this->client->request('GET', $url, $options);
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Process players data
     *
     * @throws GuzzleException
     */
    private function processGames(array $games): void
    {
        $processedCount = 0;

        $gamesData = [];

        foreach ($games as $game) {
            try {
                $this->processGame($game);
                $processedCount++;
            } catch (\Exception $e) {
                $this->warn(sprintf('Błąd przy przetwarzaniu spotkania %s: %s', $game['fixture']['date'], $e->getMessage()));
                Log::warning('Błąd przy przetwarzaniu spotkania: ' . $e->getMessage());
            }
        }
    }

    /**
     * Process individual player data
     *
     * @throws GuzzleException
     */
    private function processGame(array $game): void
    {
        $gameData = [
            'referee' => $game['fixture']['referee'],
            'stadium' => $game['fixture']['venue']['name'],
            'city' => $game['fixture']['venue']['city'],
            'date' =>  Carbon::parse($game['fixture']['date'])->format('Y-m-d H:i:s'),
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
            'home_penalty' => $game['score']['penalty']['home'] == null ? 0 : $game['score']['penalty']['home'],
            'away_penalty' => $game['score']['penalty']['away'] == null ? 0 : $game['score']['penalty']['away'],
        ];

        sleep(1);

        $this->saveGameData(['game' => $gameData]);
    }

    /**
     * Save player data to API
     *
     * @throws GuzzleException
     */
    private function saveGameData(array $requestData): void
    {
        $jsonRequest = json_encode($requestData);

        try {
            $this->client->request('POST', env('APP_URL') . '/api/game', [
                'body' => $jsonRequest,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
        } catch (\Exception $e) {
            $this->warn($e->getMessage());
            Log::warning('Błąd przy przetwarzaniu spotkania: ' . $e->getMessage());
        }
    }
}