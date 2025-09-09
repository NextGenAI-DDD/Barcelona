<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\TopAssist;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Serwis do zarządzania danymi najlepszych asystujących La Liga
 * 
 * Odpowiada za pobieranie danych z API Football i synchronizację z bazą danych
 */
readonly class TopAssistService
{
    private const LEAGUE_ID = 140;
    
    public function __construct(
        private Client $client
    ) {}

    /**
     * Pobiera wszystkich najlepszych asystujących z bazy danych
     */
    public function getAllTopAssists(): Collection
    {
        return TopAssist::orderBy('goals_assists', 'desc')->get();
    }
    
    /**
     * Pobiera asystującego po ID
     */
    public function getTopAssistById(int $id): ?TopAssist
    {
        return TopAssist::find($id);
    }

    /**
     * Tworzy nowego asystującego
     */
    public function createTopAssist(array $data): TopAssist
    {
        return TopAssist::create($data);
    }
    
    /**
     * Aktualizuje asystującego
     */
    public function updateTopAssist(int $id, array $data): bool
    {
        $topAssist = TopAssist::find($id);
        
        if (!$topAssist) {
            return false;
        }
        
        return $topAssist->update($data);
    }

    /**
     * Usuwa asystującego
     */
    public function deleteTopAssist(int $id): bool
    {
        $topAssist = TopAssist::find($id);
        
        if (!$topAssist) {
            return false;
        }
        
        return $topAssist->delete();
    }
    
    /**
     * Synchronizuje dane najlepszych asystujących z API Football
     * 
     * Pobiera dane z zewnętrznego API i aktualizuje bazę danych
     */
    public function syncTopAssists(?int $season = null): int
    {
        $season ??= $this->getCurrentSeason();
        
        $assists = $this->fetchTopAssistsFromApi($season);
        
        if (empty($assists)) {
            Log::warning('Brak danych najlepszych asystujących z API');
            return 0;
        }
        
        return DB::transaction(function () use ($assists) {
            // Wyczyść istniejące dane
            TopAssist::truncate();
            
            // Wstaw nowe dane
            $formattedAssists = array_map([$this, 'formatTopAssistData'], $assists);
            TopAssist::insert($formattedAssists);
            
            return count($formattedAssists);
        });
    }

    /**
     * Pobiera dane najlepszych asystujących z API Football
     */
    private function fetchTopAssistsFromApi(?int $season = null): array
    {
        $response = $this->makeApiRequest(
            'https://api-football-v1.p.rapidapi.com/v3/players/topassists',
            [
                'query' => [
                    'league' => self::LEAGUE_ID,
                    'season' => $season ?? $this->getCurrentSeason()
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
     * Formatuje dane asystującego do zapisu w bazie danych
     */
    private function formatTopAssistData(array $player): array
    {
        $stats = $player['statistics'][0];
        
        return [
            'name' => $player['player']['name'],
            'photo' => $player['player']['photo'],
            'games_appearances' => $stats['games']['appearences'],
            'games_minutes' => $stats['games']['minutes'],
            'games_position' => $stats['games']['position'],
            'goals_assists' => $stats['goals']['assists'],
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
        return (int) date('Y') - 1;
    }
}