<?php

namespace App\Http\Controllers\LaLiga;

use App\Http\Controllers\Controller;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::orderBy('date', 'asc')->get();

        return view('laliga.games', compact('games'));
    }
}
