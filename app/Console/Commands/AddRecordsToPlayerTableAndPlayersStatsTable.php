<?php

declare(strict_types=1);

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class AddRecordsToPlayerTableAndPlayersStatsTable extends Command
{
    private const TEAM_ID = 529;

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:add-records-to-player-table-with-stats-table';

    /**
     * The console command description.
     */
    protected $description = 'Added records to player table and player stats table from Api';

    public function __construct(
        private readonly Client $client,
        private ?int $season,
    ) {
        parent::__construct();
        $this->season = (int) date('Y') - 1;
    }

    /**
     * Execute the console command.
     *
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $this->info('Pobieranie danych zawodników...');

        try {
            $players = $this->getTeamSquad();
            $this->info(sprintf('Znaleziono %d zawodników', count($players)));

            $this->processPlayers($players);

            $this->info('Import danych zawodników zakończony!');
        } catch (\Exception $e) {
            $this->error('Wystąpił błąd: ' . $e->getMessage());
            Log::error('Błąd podczas importu danych zawodników: ' . $e->getMessage());
        }
    }

    /**
     * Get team squad data
     *
     * @throws GuzzleException
     */
    private function getTeamSquad(): array
    {
        $response = $this->makeApiRequest(
            'https://api-football-v1.p.rapidapi.com/v3/players/squads',
            ['query' => ['team' => self::TEAM_ID]]
        );

        return $response['response'][0]['players'] ?? [];
    }

    /**
     * Get player statistics
     *
     * @return array|null
     *
     * @throws GuzzleException
     */
    private function getPlayerStats(int $playerId): ?array
    {
        $response = $this->makeApiRequest(
            'https://api-football-v1.p.rapidapi.com/v3/players',
            ['query' => ['id' => $playerId, 'season' => $this->season]]
        );

        return $response['response'][0] ?? null;
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
            'X-RapidAPI-Key' => env('AUTHORIZATION_KEY_FOR_API'),
        ];

        $response = $this->client->request('GET', $url, $options);
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Process players data
     *
     * @throws GuzzleException
     */
    private function processPlayers(array $players): void
    {
        $processedCount = 0;

        foreach ($players as $player) {
            try {
                $this->processPlayer($player);
                $processedCount++;
                $this->info(sprintf('Przetworzono zawodnika %s (%d/%d)', $player['name'], $processedCount, count($players)));
            } catch (\Exception $e) {
                $this->warn(sprintf('Błąd przy przetwarzaniu zawodnika %s: %s', $player['name'], $e->getMessage()));
                Log::warning('Błąd przy przetwarzaniu zawodnika: ' . $e->getMessage());
            }
        }
    }

    /**
     * Process individual player data
     *
     * @throws GuzzleException
     */
    private function processPlayer(array $player): void
    {
        $playerStats = [];

        $stats = $this->getPlayerStats($player['id']);

        sleep(5);

        if ($stats) {
            $statsPlayer = $stats['player'];
            $statsStatistics = $stats['statistics'][0];

            $playerStats = $this->mapPlayerStats($statsPlayer, $statsStatistics);
        }

        $playersData = [[
            'name' => $player['name'],
            'age' => $player['age'],
            'number' => $player['number'],
            'position' => $player['position'],
            'photo' => $player['photo'],
            'playerStats' => $playerStats,
        ],
        ];

        $this->savePlayerData(['players' => $playersData]);
    }

    /**
     * Map player statistics
     */
    private function mapPlayerStats(array $statsPlayer, array $statsStatistics): array
    {
        return [
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

    /**
     * Save player data to API
     *
     * @throws GuzzleException
     */
    private function savePlayerData(array $requestData): void
    {
        $jsonRequest = json_encode($requestData);

        $this->client->request('POST', env('APP_URL') . '/api/player', [
            'body' => $jsonRequest,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
