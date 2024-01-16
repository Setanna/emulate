<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Race;
use App\Models\Talent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
        $genre = Genre::where('name', 'like', $name);
        if($genre->exists()){
            return response()->json(new GenreResource($genre->first()));
        }
        return response()->json(['message' => 'could not find genre'], 404);
    }

    /**
     * Get the options from the genre
     */
    public function showOptions($genre_input)
    {
        $options = [];

        try {
            // Make new genre controller
            $genre_controller = new GenreController;

            // Get genres using genre controller function showName
            $genre = $genre_controller->showName($genre_input);

            // Check if there is no error, else return genre response.
            if($genre->getStatusCode() !== 200){
                return $genre;
            }

            // get all books with the given genre id
            $book_ids = Book::all()->where('genre_id', $genre->getData()->id)->pluck('id');

            // get all talents from the books with the given genre id
            $talents = Talent::all()->whereIn('book_id', $book_ids)->first();

            // get all races from the books with the given genre id
            $races = Race::all()->whereIn('book_id', $book_ids)->first();

            // Check if the books have any content in the given category
            if (!empty($talents)) {
                array_push($options, "talents");
            }

            if (!empty($races)) {
                array_push($options, "races");
            }

            return $options;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Get the books from the genre
     */
    public function showBooks($genre_input)
    {
        $books = [];

        try {
            // Make new genre controller
            $genre_controller = new GenreController;

            // Get genres using genre controller function showName
            $genre = $genre_controller->showName($genre_input);

            // Check if there is no error, else return genre response.
            if($genre->getStatusCode() !== 200){
                return $genre;
            }

            // get all books with the given genre id
            $books = Book::all()->where('genre_id', $genre->getData()->id);

            return $books;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
