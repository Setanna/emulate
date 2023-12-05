<?php

namespace App\Http\Controllers;

use App\Http\Requests\TraitRequest;
use App\Http\Resources\TraitResource;
use App\Models\TraitModel;
use Illuminate\Http\Request;

class TraitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TraitResource::collection(TraitModel::all());
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
    public function store(TraitRequest $request)
    {
        $traitModel = TraitModel::create($request->all());

        return new TraitResource($traitModel);
    }

    /**
     * Display the specified resource.
     */
    public function show(TraitModel $traitModel)
    {
        return new TraitResource($traitModel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TraitModel $traitModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TraitModel $traitModel)
    {
        $traitModel->update($request->all());

        return new TraitResource($traitModel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TraitModel $traitModel)
    {
        $traitModel->delete();

        return response()->json(["Trait deleted"]);
    }
}
