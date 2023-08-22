<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Models\LeagueTableData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class tableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagueTableData = LeagueTableData::orderBy('rank', 'asc')->get();

        $lastApiRequestDate = Cache::get('last_api_request_date'); // Pobierz ostatnią datę z pamięci podręcznej

        // Sprawdź, czy minęło wystarczająco dużo czasu od ostatniego zapytania
        if (!$lastApiRequestDate || now()->diffInHours($lastApiRequestDate) >= 24) {
            $client = new \GuzzleHttp\Client();

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
            LeagueTableData::truncate();
            foreach ($standings as $item){
                LeagueTableData::create([
                    'rank' => $item['rank'],
                    'logo' => $item['team']['logo'],
                    'team' => $item['team']['name'],
                    'played' => $item['all']['played'],
                    'win' => $item['all']['win'],
                    'draw' => $item['all']['draw'],
                    'lose' => $item['all']['lose'],
                    'goalsFor' => $item['all']['goals']['for'],
                    'goalsAgainst' => $item['all']['goals']['against'],
                    'goalsDiff' => $item['goalsDiff'],
                    'points' => $item['points'],
                    'form' => $item['form']
                ]);
            }


            Cache::put('last_api_request_date', now(), 1440); // Zapisz datę ostatniego zapytania (24 godziny w minutach)
        }

        return view('league.table' ,compact('leagueTableData'));
    }
}

