<?php

namespace App\Http\Controllers\LaLiga;

use App\Http\Controllers\Controller;
use App\Services\TopScoreService;

class TopScoreController extends Controller
{
    public function __construct(
        private readonly TopScoreService $topScoreService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topScores = $this->topScoreService->getAllTopScorers();

        return view('laliga.topScores', compact('topScores'));
    }
}
