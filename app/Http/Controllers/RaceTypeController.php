<?php

namespace App\Http\Controllers;

use App\Http\Requests\RaceTypeRequest;
use App\Http\Resources\RaceTypeResource;
use App\Models\RaceType;
use Illuminate\Http\Request;

class RaceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RaceTypeResource::collection(RaceType::all());
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
    public function store(RaceTypeRequest $request)
    {
        $raceType = RaceType::create($request->all());

        return new RaceTypeResource($raceType);
    }

    /**
     * Display the specified resource.
     */
    public function show(RaceType $raceType)
    {
        return new RaceTypeResource($raceType);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RaceType $raceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RaceTypeRequest $request, RaceType $raceType)
    {
        $raceType->update($request->all());

        return new RaceTypeResource($raceType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RaceType $raceType)
    {
        $raceType->delete();

        return response()->json(["Race type deleted"]);
    }
}
