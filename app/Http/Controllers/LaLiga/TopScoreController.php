<?php

namespace App\Http\Controllers\LaLiga;

use App\Http\Controllers\Controller;
use App\Models\TopScore;


class TopScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $topScores = TopScore::orderBy('id', 'asc')->get();

        return view('laliga.topScores', compact('topScores'));
    }
}
