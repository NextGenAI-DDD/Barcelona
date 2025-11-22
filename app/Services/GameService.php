<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Game;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


/**
 * Serwis do zarządzania danymi meczów FC Barcelony
 * 
 * Odpowiada za pobieranie danych z API Football i synchronizację z bazą danych
 */
readonly class GameService
{
    private const TEAM_ID = 529;
    
    public function __construct(
        private Client $client
    ) {}
    
    /**
     * Pobiera wszystkie mecze z bazy danych
     */
    public function getAllGames(): Collection
    {
        return Game::orderBy('date', 'asc')->get();
    }
    
    /**
     * Pobiera mecz po ID
     */


public function getMatches(?string $dateFilter, ?string $textFilter, string $sortBy, string $sortDirection)
{
    $query = Game::query();

    if ($dateFilter) {
        $query->whereDate('date', '>=', $dateFilter);
    }

    if ($textFilter) {
        $query->where(function($q) use ($textFilter) {
            $q->where('home_team_name', 'LIKE', '%' . $textFilter . '%')
              ->orWhere('away_team_name', 'LIKE', '%' . $textFilter . '%');
        });
    }

    return $query->orderBy($sortBy, $sortDirection)->get();
}

    public function getGameById(int $id): ?Game
    {
        return Game::find($id);
    }
    
    /**
     * Tworzy nowy mecz
     */
    public function createGame(array $data): Game
    {
        return Game::create($data);
    }
    
    /**
     * Aktualizuje mecz
     */
    public function updateGame(int $id, array $data): bool
    {
        $game = Game::find($id);
        
        if (!$game) {
            return false;
        }
        
        return $game->update($data);
    }
    
    /**
     * Usuwa mecz
     */
    public function deleteGame(int $id): bool
    {
        $game = Game::find($id);
        
        if (!$game) {
            return false;
        }
        
        return $game->delete();
    }
    
    /**
     * Synchronizuje dane meczów z API Football
     * 
     * Pobiera dane z zewnętrznego API i aktualizuje bazę danych
     */
    public function syncGames(?int $season = null): int
    {
        $season ??= $this->getCurrentSeason();
        
        $games = $this->fetchGamesFromApi($season);
        
        if (empty($games)) {
            Log::warning('Brak danych meczów z API');
            return 0;
        }
        
        return DB::transaction(function () use ($games) {
            Game::truncate();
            
            // Wstaw nowe dane
            $formattedGames = array_map([$this, 'formatGameData'], $games);
            Game::insert($formattedGames);
            
            return count($formattedGames);
        });
    }
    
    /**
     * Pobiera dane meczów z API Football
     */
    private function fetchGamesFromApi(?int $season = null): array
    {
        $response = $this->makeApiRequest(
            'https://api-football-v1.p.rapidapi.com/v3/fixtures',
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
     * Formatuje dane meczu do zapisu w bazie danych
     */
    private function formatGameData(array $game): array
    {
        return [
            'referee' => $game['fixture']['referee'],
            'stadium' => $game['fixture']['venue']['name'],
            'city' => $game['fixture']['venue']['city'] ?? 'Nieznane',
            'date' => Carbon::parse($game['fixture']['date'])->format('Y-m-d H:i:s'),
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
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
    /**
     * Zwraca aktualny sezon na podstawie daty
     */
    private function getCurrentSeason(): int
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        
        if ($currentYear === false || $currentMonth === false) {
            return 2024; // fallback do aktualnego sezonu
        }
        
        $year = (int) $currentYear;
        $month = (int) $currentMonth;
        
        return $month >= 8 ? $year : $year - 1;
    }
}