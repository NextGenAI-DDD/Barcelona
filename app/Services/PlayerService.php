<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Player;
use App\Models\PlayerBarcelonaStats;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Serwis do zarządzania danymi zawodników FC Barcelony
 * 
 * Odpowiada za pobieranie danych z API Football i synchronizację z bazą danych
 */
readonly class PlayerService
{
    private const TEAM_ID = 529;
    
    public function __construct(
        private Client $client
    ) {}
    
    /**
     * Pobiera wszystkich zawodników z ich statystykami
     */
    public function getAllPlayersWithStats(): Collection
    {
        return Player::with('playerStats')->get();
    }
    
    /**
     * Pobiera zawodnika po ID
     */
    public function getPlayerById(int $id): ?Player
    {
        return Player::with('playerStats')->find($id);
    }
    
    /**
     * Tworzy nowego zawodnika
     */
    public function createPlayer(array $data): Player
    {
        return Player::create($data);
    }
    
    /**
     * Aktualizuje zawodnika
     */
    public function updatePlayer(int $id, array $data): bool
    {
        $player = Player::find($id);
        
        if (!$player) {
            return false;
        }
        
        return $player->update($data);
    }
    
    /**
     * Usuwa zawodnika
     */
    public function deletePlayer(int $id): bool
    {
        $player = Player::find($id);
        
        if (!$player) {
            return false;
        }
        
        return $player->delete();
    }
    
    /**
     * Synchronizuje dane zawodników z API Football
     * 
     * Pobiera dane z zewnętrznego API i aktualizuje bazę danych
     */
    public function syncPlayers(?int $season = null): int
    {
        $season ??= $this->getCurrentSeason();
        
        $players = $this->fetchPlayersFromApi($season);
        
        if (empty($players)) {
            Log::warning('Brak danych zawodników z API');
            return 0;
        }
        
        return DB::transaction(function () use ($players) {
            // Wyczyść istniejące dane - tymczasowo wyłączamy sprawdzanie foreign key
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            PlayerBarcelonaStats::truncate();
            Player::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            
            $syncedCount = 0;
            
            foreach ($players as $playerData) {
                $player = $this->createPlayerFromApiData($playerData);
                
                if ($player) {
                    $this->createPlayerStatsFromApiData($player->id, $playerData);
                    $syncedCount++;
                }
            }
            
            return $syncedCount;
        });
    }
    
    /**
     * Pobiera dane zawodników z API Football
     */
    private function fetchPlayersFromApi(?int $season = null): array
    {
        $response = $this->makeApiRequest(
            'https://api-football-v1.p.rapidapi.com/v3/players',
            [
                'query' => [
                    'team' => self::TEAM_ID,
                    'season' => $season
                ]
            ]
        );
        
        return $response['response'] ?? [];
    }
    
    /**
     * Wykonuje zapytanie do API
     */
    private function makeApiRequest(string $url, array $options = []): array
    {
        $options['headers'] = [
            'X-RapidAPI-Host' => config('services.api_football.host'),
            'X-RapidAPI-Key' => config('services.api_football.key'),
        ];
        
        $response = $this->client->request('GET', $url, $options);
        return json_decode((string) $response->getBody(), true);
    }
    
    /**
     * Tworzy zawodnika na podstawie danych z API
     */
    private function createPlayerFromApiData(array $playerData): ?Player
    {
        $player = $playerData['player'];
        
        return Player::create([
            'name' => $player['name'],
            'age' => $player['age'],
            'number' => $playerData['statistics'][0]['games']['number'] ?? null,
            'position' => $playerData['statistics'][0]['games']['position'],
            'photo' => $player['photo'],
        ]);
    }
    
    /**
     * Tworzy statystyki zawodnika na podstawie danych z API
     */
    private function createPlayerStatsFromApiData(int $playerId, array $playerData): void
    {
        $player = $playerData['player'];
        $stats = $playerData['statistics'][0];
        
        PlayerBarcelonaStats::create([
            'player_id' => $playerId,
            'birth_date' => $player['birth']['date'] ?? null,
            'height' => $player['height'] ?? null,
            'weight' => $player['weight'] ?? null,
            'nationality' => $player['nationality'] ?? null,
            'injured' => $player['injured'] ?? false,
            'games_appearances' => $stats['games']['appearences'] ?? 0,
            'games_lineups' => $stats['games']['lineups'] ?? 0,
            'games_minutes' => $stats['games']['minutes'] ?? 0,
            'games_rating' => $stats['games']['rating'] ? (int) round((float) $stats['games']['rating']) : null,
            'substitutes_in' => $stats['substitutes']['in'] ?? 0,
            'substitutes_out' => $stats['substitutes']['out'] ?? 0,
            'substitutes_bench' => $stats['substitutes']['bench'] ?? 0,
            'shots_total' => $stats['shots']['total'] ?? 0,
            'shots_on' => $stats['shots']['on'] ?? 0,
            'goals_total' => $stats['goals']['total'] ?? 0,
            'goals_conceded' => $stats['goals']['conceded'] ?? 0,
            'goals_assists' => $stats['goals']['assists'] ?? 0,
            'goals_saves' => $stats['goals']['saves'] ?? 0,
            'passes_total' => $stats['passes']['total'] ?? 0,
            'passes_key' => $stats['passes']['key'] ?? 0,
            'passes_accuracy' => $stats['passes']['accuracy'] ?? 0,
            'tackles_total' => $stats['tackles']['total'] ?? 0,
            'tackles_blocks' => $stats['tackles']['blocks'] ?? 0,
            'tackles_interceptions' => $stats['tackles']['interceptions'] ?? 0,
            'duels_total' => $stats['duels']['total'] ?? 0,
            'duels_won' => $stats['duels']['won'] ?? 0,
            'dribbles_attempts' => $stats['dribbles']['attempts'] ?? 0,
            'dribbles_success' => $stats['dribbles']['success'] ?? 0,
            'dribbles_past' => $stats['dribbles']['past'] ?? 0,
            'fouls_drawn' => $stats['fouls']['drawn'] ?? 0,
            'fouls_committed' => $stats['fouls']['committed'] ?? 0,
            'cards_yellow' => $stats['cards']['yellow'] ?? 0,
            'cards_yellowred' => $stats['cards']['yellowred'] ?? 0,
            'cards_red' => $stats['cards']['red'] ?? 0,
            'penalty_won' => $stats['penalty']['won'] ?? 0,
            'penalty_committed' => $stats['penalty']['commited'] ?? 0,
            'penalty_scored' => $stats['penalty']['scored'] ?? 0,
            'penalty_missed' => $stats['penalty']['missed'] ?? 0,
            'penalty_saved' => $stats['penalty']['saved'] ?? 0,
        ]);
    }
    
    /**
     * Zwraca aktualny sezon na podstawie daty
     */
    private function getCurrentSeason(): int
    {
        $year = (int) date('Y');
        
        return $year;
    }
}