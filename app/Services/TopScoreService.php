<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\TopScore;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Serwis do zarządzania danymi najlepszych strzelców La Liga
 * 
 * Odpowiada za pobieranie danych z API Football i synchronizację z bazą danych
 */
readonly class TopScoreService
{
    private const LEAGUE_ID = 140;
    
    public function __construct(
        private Client $client
    ) {}
    
    /**
     * Pobiera wszystkich najlepszych strzelców z bazy danych
     */
    public function getAllTopScorers(): Collection
    {
        return TopScore::orderBy('goals', 'desc')->get();
    }
    
    /**
     * Pobiera strzelca po ID
     */
    public function getTopScorerById(int $id): ?TopScore
    {
        return TopScore::find($id);
    }
    
    /**
     * Tworzy nowego strzelca
     */
    public function createTopScorer(array $data): TopScore
    {
        return TopScore::create($data);
    }
    
    /**
     * Aktualizuje strzelca
     */
    public function updateTopScorer(int $id, array $data): bool
    {
        $topScorer = TopScore::find($id);
        
        if (!$topScorer) {
            return false;
        }
        
        return $topScorer->update($data);
    }
    
    /**
     * Usuwa strzelca
     */
    public function deleteTopScorer(int $id): bool
    {
        $topScorer = TopScore::find($id);
        
        if (!$topScorer) {
            return false;
        }
        
        return $topScorer->delete();
    }
    
    /**
     * Synchronizuje dane najlepszych strzelców z API Football
     * 
     * Pobiera dane z zewnętrznego API i aktualizuje bazę danych
     */
    public function syncTopScorers(?int $season = null): int
    {
        $season ??= $this->getCurrentSeason();
        
        $scorers = $this->fetchTopScorersFromApi($season);
        
        if (empty($scorers)) {
            Log::warning('Brak danych najlepszych strzelców z API');
            return 0;
        }
        
        return DB::transaction(function () use ($scorers) {
            // Wyczyść istniejące dane
            TopScore::truncate();
            
            // Wstaw nowe dane
            $formattedScorers = array_map([$this, 'formatTopScorerData'], $scorers);
            TopScore::insert($formattedScorers);
            
            return count($formattedScorers);
        });
    }
    
    /**
     * Pobiera dane najlepszych strzelców z API Football
     */
    private function fetchTopScorersFromApi(?int $season = null): array
    {
        $response = $this->makeApiRequest(
            'https://api-football-v1.p.rapidapi.com/v3/players/topscorers',
            [
                'query' => [
                    'league' => self::LEAGUE_ID,
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
     * Formatuje dane strzelca do zapisu w bazie danych
     */
    private function formatTopScorerData(array $player): array
    {
        $stats = $player['statistics'][0];
        
        return [
            'name' => $player['player']['name'],
            'photo' => $player['player']['photo'],
            'games_appearances' => $stats['games']['appearences'],
            'games_minutes' => $stats['games']['minutes'],
            'games_position' => $stats['games']['position'],
            'goals' => $stats['goals']['total'],
            'club_name' => $stats['team']['name'],
            'club_logo' => $stats['team']['logo'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
    /**
     * Zwraca aktualny sezon na podstawie daty
     */
    private function getCurrentSeason(): int
    {
        return (int) date('Y');
    }
}