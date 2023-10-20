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
        $playerData = $request->validated();


            $player = Player::create($playerData);

            // Dodaj pracowników do firmy, jeśli są przesłani w żądaniu
            if ($request->has('playerStats')) {
                $playerStatsData = $request->input('playerStats');
                $stats = $player->playerStats()->create($playerStatsData);
            }


        return response()->json("Company Added");

    }
}
