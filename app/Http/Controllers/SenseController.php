<?php

namespace App\Http\Controllers;

use App\Http\Requests\SenseRequest;
use App\Http\Resources\SenseResource;
use App\Models\Sense;
use Illuminate\Http\Request;

class SenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SenseResource::collection(Sense::all());
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
    public function store(SenseRequest $request)
    {
        $sense = Sense::create($request->all());

        return new SenseResource($sense);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sense $sense)
    {
        return new SenseResource($sense);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sense $sense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SenseRequest $request, Sense $sense)
    {
        $sense->update($request->all());

        return new SenseResource($sense);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sense $sense)
    {
        $sense->delete();

        return response()->json(["Sense deleted"]);
    }
}
