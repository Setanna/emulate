<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GenreResource::collection(Genre::all());
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
    public function store(GenreRequest $request)
    {
        $genre = Genre::create($request->all());

        return new GenreResource($genre);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return new GenreResource($genre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        $genre->update($request->all());

        return new GenreResource($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json(["Genre deleted"]);
    }

    /* Custom Functions */

    /**
     * Display the specified resource by name.
     */
    public function showName($name)
    {
        return new GenreResource(Genre::where('name', 'like', $name)->first());
    }
}
