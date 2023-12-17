<?php

namespace App\Http\Controllers\Api\LaLiga;

use App\Http\Controllers\Controller;
use App\Http\Requests\GamesRequest;
use App\Http\Resources\GamesResource;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $game = Game::all();
        return GamesResource::collection($game);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GamesRequest $request)
    {
        $data = $request->validated();
        $resources = [];

        foreach ($data as $item) {
            $game = Game::create($item);
            $resources[] = new GamesResource($game);
        }

        return GamesResource::collection($resources);
    }

}
