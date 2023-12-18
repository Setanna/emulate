<?php

namespace App\Http\Controllers;

use App\Http\Requests\RaceSenseRequest;
use App\Http\Resources\RaceSenseResource;
use App\Models\RaceSense;
use Illuminate\Http\Request;

class RaceSenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RaceSenseResource::collection(RaceSense::all());
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
    public function store(RaceSenseRequest $request)
    {
        $raceSense = RaceSense::create($request->all());

        return new RaceSenseResource($raceSense);
    }

    /**
     * Display the specified resource.
     */
    public function show(RaceSense $raceSense)
    {
        return new RaceSenseResource($raceSense);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RaceSense $raceSense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RaceSenseRequest $request, RaceSense $raceSense)
    {
        $raceSense->update($request->all());

        return new RaceSenseResource($raceSense);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RaceSense $raceSense)
    {
        $raceSense->delete();

        return response()->json(["Race sense deleted"]);
    }
}
