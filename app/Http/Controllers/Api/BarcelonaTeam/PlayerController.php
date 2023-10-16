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

        $resources = [];

        foreach ($playerData as $item){
            $player = Player::create($item);

            // Add players stats if are in request
            if ($request->has('playerStats')) {
                $playerData = $request->input('playerStats');

                $playerStats = $player->playersStats()->create($playerData);

                $resources[] = new PlayerResource($player);
            }
        }

        return PlayerResource::collection($resources);
    }

}
