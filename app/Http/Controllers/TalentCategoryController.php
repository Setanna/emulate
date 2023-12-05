<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalentCategoryRequest;
use App\Http\Resources\TalentCategoryResource;
use App\Models\TalentCategory;
use Illuminate\Http\Request;

class TalentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TalentCategoryResource::collection(TalentCategory::all());
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
    public function store(TalentCategoryRequest $request)
    {
        $talentCategory = TalentCategory::create($request->all());

        return new TalentCategoryResource($talentCategory);
    }

    /**
     * Display the specified resource.
     */
    public function show(TalentCategory $talentCategory)
    {
        return new TalentCategoryResource($talentCategory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TalentCategory $talentCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TalentCategory $talentCategory)
    {
        $talentCategory->update($request->all());

        return new TalentCategoryResource($talentCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TalentCategory $talentCategory)
    {
        $talentCategory->delete();

        return response()->json(["Category deleted"]);
    }
}
