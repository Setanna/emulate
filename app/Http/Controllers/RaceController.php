<?php

namespace App\Http\Controllers;

use App\Http\Requests\RaceRequest;
use App\Http\Resources\RaceResource;
use App\Models\Book;
use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RaceResource::collection(Race::all());
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
    public function store(RaceRequest $request)
    {
        $race = Race::create($request->all());

        return new RaceResource($race);
    }

    /**
     * Display the specified resource.
     */
    public function show(Race $race)
    {
        return new RaceResource($race);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Race $race)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RaceRequest $request, Race $race)
    {
        $race->update($request->all());

        return new RaceResource($race);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Race $race)
    {
        $race->delete();

        return response()->json(["Race deleted"]);
    }

    /* Custom Functions */

    /**
     * Display talents by genre.
     */
    public function getRacesByGenre($genre_input)
    {
        try {
            // get the genre by comparing lowercase to lowercase
            $genre = DB::table('genres')->where('name', 'LIKE', '%' . $genre_input . '%')->get();

            // If the genre is not a lowercase match throw exception (LIKE allows fantas to get fantasy genre, but is needed for lowercase DB query without using RAW)
            if(strtolower($genre[0]->name) !== strtolower($genre_input)){
                throw ValidationException::withMessages(['message' => 'could not find genre']);
            }

            // get all books with the given genre id
            $book_ids = Book::all()->where('genre_id', $genre[0]->id)->pluck('id');

            // get all talents from the books with the given genre id
            $races = Race::all()->whereIn('book_id', $book_ids);

            // return the array with the talent resource
            return RaceResource::collection($races);
        } catch (\Exception $e) {
            return response()->json(["Could not find genre"],404);
        }
    }
}
