<?php

namespace App\Http\Controllers\Api\LaLiga;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopScoreRequest;
use App\Http\Resources\TopScoreResource;
use App\Models\TopScore;
use Illuminate\Http\Request;

class TopScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topScore = TopScore::all();

        return TopScoreResource::collection($topScore);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopScoreRequest $request)
    {
        $data = $request->validated();
        $resources = [];

        foreach ($data as $item) {
            $topScore = TopScore::create($item);
            $resources[] = new TopScoreResource($topScore);
        }

        return TopScoreResource::collection($resources);
    }

}
