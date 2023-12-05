<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalentTraitRequest;
use App\Http\Resources\TalentTraitResource;
use App\Models\TalentTrait;
use Illuminate\Http\Request;

class TalentTraitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TalentTraitResource::collection(TalentTrait::all());
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
    public function store(TalentTraitRequest $request)
    {
        $talentTrait = TalentTrait::create($request->all());

        return new TalentTraitResource($talentTrait);
    }

    /**
     * Display the specified resource.
     */
    public function show(TalentTrait $talentTrait)
    {
        return new TalentTraitResource($talentTrait);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TalentTrait $talentTrait)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TalentTraitRequest $request, TalentTrait $talentTrait)
    {
        $talentTrait->update($request->all());

        return new TalentTraitResource($talentTrait);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TalentTrait $talentTrait)
    {
        $talentTrait->delete();

        return response()->json(["Trait deleted"]);
    }
}
