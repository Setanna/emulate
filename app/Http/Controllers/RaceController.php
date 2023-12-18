<?php

namespace App\Http\Controllers;

use App\Http\Requests\RaceRequest;
use App\Http\Resources\RaceResource;
use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RaceResource::collection(Race::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RaceRequest $request)
    {
        $race = Race::create($request->all());

        return new RaceResource($race);
    }

    /**
     * Display the specified resource.
     */
    public function show(Race $race)
    {
        return new RaceResource($race);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Race $race)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RaceRequest $request, Race $race)
    {
        $race->update($request->all());

        return new RaceResource($race);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Race $race)
    {
        $race->delete();

        return response()->json(["Race deleted"]);
    }
}
