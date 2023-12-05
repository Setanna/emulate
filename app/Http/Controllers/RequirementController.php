<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequirementRequest;
use App\Http\Resources\RequirementResource;
use App\Models\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RequirementResource::collection(Requirement::all());
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
    public function store(RequirementRequest $request)
    {
        $requirement = Requirement::create($request->all());

        return new RequirementResource($requirement);
    }

    /**
     * Display the specified resource.
     */
    public function show(Requirement $requirement)
    {
        return new RequirementResource($requirement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requirement $requirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequirementRequest $request, Requirement $requirement)
    {
        $requirement->update($request->all());

        return new RequirementResource($requirement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requirement $requirement)
    {
        $requirement->delete();

        return response()->json(["Requirement deleted"]);
    }
}
