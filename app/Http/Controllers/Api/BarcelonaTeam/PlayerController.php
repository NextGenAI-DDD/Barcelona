<?php

namespace App\Http\Controllers\Api\BarcelonaTeam;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Faker\Provider\Company;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $player = Player::with('playerStats')->get();

        return PlayerResource::collection($player);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayerRequest $request)
    {
        $playersData = $request->validated();

        // Sprawdź, czy dane zawierają listę piłkarzy
        if ($request->has('players')) {
            $players = $request->input('players');

            // Iteruj przez listę piłkarzy i zapisz każdego z nich
            foreach ($players as $playerData) {
                $player = Player::create($playerData);

                // Sprawdź, czy statystyki piłkarza są dostępne
                if (isset($playerData['playerStats'])) {
                    $playerStatsData = $playerData['playerStats'];
                    $stats = $player->playerStats()->create($playerStatsData);
                }
            }
        }

        return response()->json("Players Added");

    }
}
