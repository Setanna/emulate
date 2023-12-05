<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleRequest;
use App\Http\Resources\RuleResource;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RuleResource::collection(Rule::all());
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
    public function store(RuleRequest $request)
    {
        $rule = Rule::create($request->all());

        return new RuleResource($rule);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rule $rule)
    {
        return new RuleResource($rule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rule $rule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RuleRequest $request, Rule $rule)
    {
        $rule->update($request->all());

        return new RuleResource($rule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rule $rule)
    {
        $rule->delete();

        return response()->json(["Rule deleted"]);
    }
}
