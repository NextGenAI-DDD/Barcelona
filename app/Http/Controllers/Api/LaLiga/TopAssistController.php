<?php

namespace App\Http\Controllers\Api\LaLiga;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopAssistRequest;
use App\Http\Resources\TopAssistResource;
use App\Models\TopAssist;

class TopAssistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $topAssist = TopAssist::all();

        return TopAssistResource::collection($topAssist);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopAssistRequest $request)
    {
        $topAssist = TopAssist::create($request->validated());

        return new TopAssistResource($topAssist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopAssistRequest $request, TopAssist $topAssist)
    {
        $topAssist->update($request->validated());

        return new TopAssistResource($topAssist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TopAssist $topAssist)
    {
        $topAssist->delete();

        return response()->json(['message'=>'Team deleted']);
    }
}
