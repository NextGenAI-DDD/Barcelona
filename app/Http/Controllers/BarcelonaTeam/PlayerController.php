<?php

namespace App\Http\Controllers\BarcelonaTeam;

use App\Http\Controllers\Controller;
use App\Services\PlayerService;
use Illuminate\Contracts\Support\Renderable;

class PlayerController extends Controller
{
    public function __construct(
        private readonly PlayerService $playerService
    ) {}

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $players = $this->playerService->getAllPlayersWithStats();

        return view('barcelona.players', compact('players'));
    }
}
