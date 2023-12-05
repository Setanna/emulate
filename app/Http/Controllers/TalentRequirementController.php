<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalentRequirementRequest;
use App\Http\Resources\TalentRequirementResource;
use App\Models\TalentRequirement;
use Illuminate\Http\Request;

class TalentRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TalentRequirementResource::collection(TalentRequirement::all());
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
    public function store(TalentRequirementRequest $request)
    {

        $talentRequirement = TalentRequirement::create($request->all());

        return new TalentRequirementResource($talentRequirement);
    }

    /**
     * Display the specified resource.
     */
    public function show(TalentRequirement $talentRequirement)
    {
        return new TalentRequirementResource($talentRequirement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TalentRequirement $talentRequirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TalentRequirementRequest $request, TalentRequirement $talentRequirement)
    {
        $talentRequirement->update($request->all());

        return new TalentRequirementResource($talentRequirement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TalentRequirement $talentRequirement)
    {
        $talentRequirement->delete();

        return response()->json(["Talent Requirement deleted"]);
    }
}
