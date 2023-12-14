<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalentRequest;
use App\Http\Resources\TalentResource;
use App\Models\Book;
use App\Models\Genre;
use App\Http\Resources\GenreResource;
use App\Models\Talent;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use function Clue\StreamFilter\remove;

class TalentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TalentResource::collection(Talent::all());
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
    public function store(TalentRequest $request)
    {
        $talent = Talent::create($request->all());

        return new TalentResource($talent);
    }

    /**
     * Display the specified resource.
     */
    public function show(Talent $talent)
    {
        return new TalentResource($talent);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talent $talent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TalentRequest $request, Talent $talent)
    {
        $talent->update($request->all());

        return new TalentResource($talent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talent $talent)
    {
        $talent->delete();

        return response()->json(["Talent deleted"]);
    }

    /* Custom Functions */

    /**
     * Display talents by genre.
     */
    public function showGenre($genre_input)
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
            $talents = Talent::all()->whereIn('book_id', $book_ids);

            // return the array with the talent resource
            return TalentResource::collection($talents);
        } catch (\Exception $e) {
            return response()->json(["Could not find genre"],404);
        }
    }
}
