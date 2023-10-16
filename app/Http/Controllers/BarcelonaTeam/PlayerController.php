<?php

namespace App\Http\Controllers\BarcelonaTeam;

use App\Http\Controllers\Controller;
use App\Models\playerBarcelonaStats;
use App\Models\player;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Cache;

class PlayerController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     * @throws GuzzleException
     */
    public function index(): Renderable
    {
        return self::index();
    }
}
