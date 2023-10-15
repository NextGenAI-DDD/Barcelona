<?php

namespace App\Http\Controllers\Api\LaLiga;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaLigaTabelaRequest;
use App\Http\Resources\LaLigaTabelaResource;
use App\Models\LaLigaTable;

class LaLigaTabelaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laLigaTable = LaLigaTable::all();
        return LaLigaTabelaResource::collection($laLigaTable);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaLigaTabelaRequest $request)
    {
        $data = $request->validated();
        $resources = [];

        foreach ($data as $item) {
            $team = LaLigaTable::create($item);
            $resources[] = new LaLigaTabelaResource($team);
        }

        return LaLigaTabelaResource::collection($resources);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LaLigaTabelaRequest $request, LaLigaTable $laLigaTable)
    {
        $laLigaTable->update($request->required());

        return new LaLigaTabelaResource($laLigaTable);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaLigaTable $laLigaTable)
    {
        $laLigaTable->delete();

        return response()->json(['message'=>'Team deleted']);
    }
}
