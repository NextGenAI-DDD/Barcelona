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
        $data = $request->validated();
        $resources = [];

        foreach ($data as $item) {
            $topAssist = TopAssist::create($item);
            $resources[] = new TopAssistResource($topAssist);
        }

        return TopAssistResource::collection($resources);
    }

}
