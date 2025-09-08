<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\LaLigaTable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Serwis do zarządzania danymi La Liga
 * Zastępuje poprzednie API endpoints prostym CRUD-em
 */
final readonly class LaLigaService
{
    public function __construct(
        private Client $client
    ) {}

    /**
     * Pobiera aktualne dane tabeli La Liga z zewnętrznego API
     */
    public function fetchStandingsFromApi(int $season): array
    {
        
        $url = sprintf(
            'https://api-football-v1.p.rapidapi.com/v3/standings?season=%d&league=140',
            $season
        );

        try {
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'X-RapidApi-Host' => config('services.api_football.host'),
                    'X-RapidApi-Key' => config('services.api_football.key'),
                ]
            ]);

            $data = json_decode((string)$response->getBody(), true);
            return $data['response'][0]['league']['standings'][0] ?? [];
        } catch (GuzzleException $e) {
            Log::error('Błąd podczas pobierania danych z API: ' . $e->getMessage());
            throw new \RuntimeException('Nie udało się pobrać danych z API: ' . $e->getMessage());
        }
    }

    /**
     * Synchronizuje dane tabeli - usuwa stare i dodaje nowe
     */
    public function syncStandings(?int $season = null): int
    {
        $season ??= $this->getCurrentSeason();
        $standings = $this->fetchStandingsFromApi($season);
        
        if (empty($standings)) {
            throw new \RuntimeException('Brak danych do synchronizacji');
        }

        return DB::transaction(function () use ($standings) {
            // Usuń stare dane
            LaLigaTable::truncate();
            
            // Dodaj nowe dane
            $formattedData = $this->formatStandingsData($standings);
            LaLigaTable::insert($formattedData);
            
            return count($formattedData);
        });
    }

    /**
     * Pobiera wszystkie drużyny z tabeli
     */
    public function getAllTeams(): Collection
    {
        return LaLigaTable::orderBy('rank')->get();
    }

    /**
     * Pobiera drużynę według pozycji w tabeli
     */
    public function getTeamByRank(int $rank): ?LaLigaTable
    {
        return LaLigaTable::where('rank', $rank)->first();
    }

    /**
     * Pobiera drużynę według nazwy
     */
    public function getTeamByName(string $name): ?LaLigaTable
    {
        return LaLigaTable::where('team', 'like', "%{$name}%")->first();
    }

    /**
     * Formatuje dane z API do struktury bazy danych
     */
    private function formatStandingsData(array $standings): array
    {
        return array_map(fn(array $item) => [
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
            'form' => $item['form'],
            'created_at' => now(),
            'updated_at' => now(),
        ], $standings);
    }

    /**
     * Określa aktualny sezon na podstawie daty
     */
    private function getCurrentSeason(): int
    {
        $year = (int) date('Y');
        $month = (int) date('n');
        
        return $month >= 8 ? $year : $year - 1;
    }
}