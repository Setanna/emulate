<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalentRequest;
use App\Http\Resources\TalentResource;
use App\Models\Talent;
use Illuminate\Http\Request;

class TalentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TalentResource::collection(Talent::all());
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
    public function store(TalentRequest $request)
    {
        $talent = Talent::create($request->all());

        return new TalentResource($talent);
    }

    /**
     * Display the specified resource.
     */
    public function show(Talent $talent)
    {
        return new TalentResource($talent);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talent $talent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TalentRequest $request, Talent $talent)
    {
        $talent->update($request->all());

        return new TalentResource($talent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talent $talent)
    {
        $talent->delete();

        return response()->json(["Talent deleted"]);
    }

    /* Custom Functions */

    /**
     * Display talents by genre.
     */
    public function showGenre($genre)
    {
        $talents = $this->index();
        return $talents->collect(['genre' => $genre]);
    }
}
