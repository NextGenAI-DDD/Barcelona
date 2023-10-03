<?php

namespace App\Http\Controllers\LaLiga;

use App\Http\Controllers\Controller;
use App\Models\LaLigaTable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class LaLigaTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     * @throws GuzzleException
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $leagueTableData = LaLigaTable::orderBy('rank', 'asc')->get();

        $lastApiRequestDate = Cache::get('last_api_request_date'); // Pobierz ostatnią datę z pamięci podręcznej

        // Sprawdź, czy minęło wystarczająco dużo czasu od ostatniego zapytania
        if (!$lastApiRequestDate || now()->diffInHours($lastApiRequestDate) >= 24) {
            $client = new Client();

            $response = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/standings?season=2023&league=140', [
                'headers' => [
                    'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'b918db7937msh635c1bfaeff0577p1e7a14jsn98d8e96cd7ec',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            $league = $data['response'][0]['league'];

            $standings = $league['standings'][0];

            // Zapisz pobrane dane do bazy danych
            LaLigaTable::truncate();
            foreach ($standings as $item){
                LaLigaTable::create([
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
                ]);
            }


            Cache::put('last_api_request_date', now(), 1440); // Zapisz datę ostatniego zapytania (24 godziny w minutach)
        }

        return view('laliga.table' ,compact('leagueTableData'));
    }
}

