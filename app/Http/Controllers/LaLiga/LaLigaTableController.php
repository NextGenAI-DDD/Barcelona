<?php

namespace App\Http\Controllers\LaLiga;

use App\Http\Controllers\Controller;
use App\Models\LaLigaTable;
class LaLigaTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     *
     */
    public function index()
    {
        $leagueTableData = LaLigaTable::orderBy('rank', 'asc')->get();

        return view('laliga.table', compact('leagueTableData'));
    }
}

