<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequiredTalentRequest;
use App\Http\Resources\RequiredTalentResource;
use App\Models\RequiredTalent;
use Illuminate\Http\Request;

class RequiredTalentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RequiredTalentResource::collection(RequiredTalent::all());
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
    public function store(RequiredTalentRequest $request)
    {
        $requiredTalent = RequiredTalent::create($request->all());

        return new RequiredTalentResource($requiredTalent);
    }

    /**
     * Display the specified resource.
     */
    public function show(RequiredTalent $requiredTalent)
    {
        return new RequiredTalentResource($requiredTalent);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequiredTalent $requiredTalent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequiredTalentRequest $request, RequiredTalent $requiredTalent)
    {
        $requiredTalent->update($request->all());

        return new RequiredTalentResource($requiredTalent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequiredTalent $requiredTalent)
    {
        $requiredTalent->delete();

        return response()->json(["Required Talent deleted"]);
    }
}
