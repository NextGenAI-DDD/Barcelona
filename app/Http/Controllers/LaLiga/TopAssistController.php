<?php

namespace App\Http\Controllers\LaLiga;

use App\Http\Controllers\Controller;
use App\Services\TopAssistService;

class TopAssistController extends Controller
{
    public function __construct(
        private readonly TopAssistService $topAssistService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topAssistants = $this->topAssistService->getAllTopAssists();

        return view('laliga.topAssistants', compact('topAssistants'));
    }
}
