<?php

namespace App\Http\Controllers\LaLiga;

use App\Http\Controllers\Controller;
use App\Models\TopAssist;


class TopAssistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $topAssistants = TopAssist::orderBy('id', 'asc')->get();

        return view('laliga.topAssistants', compact('topAssistants'));
    }
}
