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
        // Make new genre controller
        $genre_controller = new GenreController;

        // Get genres using genre controller function showName
        $genre = $genre_controller->showName($genre_input);

        // Check if there is no error, else return genre.
        if($genre->getStatusCode() !== 200){
            return $genre;
        }

        // get all books with the given genre id
        $book_ids = Book::all()->where('genre_id', $genre->getData()->id)->pluck('id');

        // get all talents from the books with the given genre id
        $races = Race::all()->whereIn('book_id', $book_ids);

        // return the array with the talent resource
        return RaceResource::collection($races);
    }

    /**
     * Display race by genre name and talent id.
     */
    public function getRaceByGenre($genre_input, Race $race)
    {
        // Make new genre controller
        $genre_controller = new GenreController;

        // Get genres using genre controller function showName
        $genre = $genre_controller->showName($genre_input);

        // Check if there is no error, else return genre response.
        if ($genre->getStatusCode() !== 200) {
            return $race;
        }

        // Get the book id the talent is in
        $book_id = [$race->book_id];

        // Get the genre_id of the book
        $genre_id = Book::whereIn('id', $book_id)->get()->pluck('genre_id');

        if ($genre_id[0] === $genre->getData()->id) {
            return new RaceResource($race);
        }
        return response()->json(['message' => 'could not find race in given genre'], 404);
    }
}
