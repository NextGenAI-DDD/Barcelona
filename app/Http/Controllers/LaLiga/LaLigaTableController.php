<?php

namespace App\Http\Controllers\LaLiga;

use App\Http\Controllers\Controller;
use App\Services\LaLigaService;

class LaLigaTableController extends Controller
{
    public function __construct(
        private readonly LaLigaService $laLigaService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $leagueTableData = $this->laLigaService->getAllTeams();

        return view('laliga.table', compact('leagueTableData'));
    }
}

