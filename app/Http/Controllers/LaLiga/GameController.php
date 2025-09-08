<?php

namespace App\Http\Controllers\LaLiga;

use App\Http\Controllers\Controller;
use App\Services\GameService;

class GameController extends Controller
{
    public function __construct(
        private readonly GameService $gameService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = $this->gameService->getAllGames();

        return view('laliga.games', compact('games'));
    }
}
