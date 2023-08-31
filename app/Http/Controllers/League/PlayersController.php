<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Models\playerLaligaStats;
use App\Models\players;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PlayersController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     * @throws GuzzleException
     */
    public function index(): Renderable
    {
        $players = players::get();
        $playersStatic = playerLaligaStats::get();

        $lastApiRequestDate = Cache::get('last_api_request_date');
        if (!$lastApiRequestDate || now()->diffInHours($lastApiRequestDate) >= 24) {
            $client = new Client();

            $response = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/players?team=529&season=2023', [
                'headers' => [
                    'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'b918db7937msh635c1bfaeff0577p1e7a14jsn98d8e96cd7ec',
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            $jsonResponse = $data['response'];
            playerLaligaStats::truncate();
            players::resetPlayerTable();

              foreach ($jsonResponse as $player){
                $statistics = $player['statistics'][0];
                  $createdPlayer = players::create([
                    'name' => $player['player']['name'],
                    'age' => $player['player']['age'],
                    'position' => $player['statistics'][0]['games']['position'],
                    'birth' => $player['player']['birth']['date'],
                    'place' => $player['player']['birth']['place'],
                    'country' => $player['player']['birth']['country'],
                    'nationality' => $player['player']['nationality'],
                    'height' => $player['player']['height'],
                    'weight' => $player['player']['weight'],
                    'injured' => $player['player']['injured'],
                    'photo' => $player['player']['photo'],
                ]);

                playerLaligaStats::create([
                    'player_id' => $createdPlayer->id,
                    'appearences_games' => $statistics['games']['appearences'],
                    'lineups_games' => $statistics['games']['lineups'],
                    'minutes_games' => $statistics['games']['minutes'],
                    'rating_games' => $statistics['games']['rating'],
                    'in_substitutes' => $statistics['substitutes']['in'],
                    'out_substitutes' => $statistics['substitutes']['out'],
                    'bench_substitutes' => $statistics['substitutes']['bench'],
                    'total_shots' => $statistics['shots']['total'],
                    'total_on' => $statistics['shots']['total'],
                    'total_goals' => $statistics['goals']['total'],
                    'conceded_goals' => $statistics['goals']['conceded'],
                    'assists_goals' => $statistics['goals']['assists'],
                    'saves_goals' => $statistics['goals']['saves'],
                    'total_passes' => $statistics['passes']['total'],
                    'key_passes' => $statistics['passes']['key'],
                    'accuracy_passes' => $statistics['passes']['accuracy'],
                    'total_tackles' => $statistics['tackles']['total'],
                    'blocks_tackles' => $statistics['tackles']['blocks'],
                    'interceptions_tackles' => $statistics['tackles']['interceptions'],
                    'total_duels' => $statistics['duels']['total'],
                    'won_duels' => $statistics['duels']['won'],
                    'attempts_dribbles' => $statistics['dribbles']['attempts'],
                    'success_dribbles' => $statistics['dribbles']['success'],
                    'past_dribbles' => $statistics['dribbles']['past'],
                    'drawn_fouls' => $statistics['fouls']['drawn'],
                    'committed_fouls' => $statistics['fouls']['committed'],
                    'yellow_cards' => $statistics['cards']['yellow'],
                    'yellowred_cards' => $statistics['cards']['yellowred'],
                    'red_cards' => $statistics['cards']['red'],
                    'won_penalty' => $statistics['penalty']['won'],
                    'commited_penalty' => $statistics['penalty']['commited'],
                    'scored_penalty' => $statistics['penalty']['scored'],
                    'missed_penalty' => $statistics['penalty']['missed'],
                    'saved_penalty' => $statistics['penalty']['saved'],
                ]);
            }






            Cache::put('last_api_request_date', now(), 1440); // Zapisz datę ostatniego zapytania (24 godziny w minutach)
        }
        return view('league.players', compact('players', 'playersStatic'));
    }
}
