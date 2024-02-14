<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalentRequest;
use App\Http\Resources\TalentResource;
use App\Models\Book;
use App\Models\Category;
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
    public function update(Request $request, Talent $talent)
    {
        $talent->update($request->all(), [
            'name' => ['unique:talent,name,' . $talent->id],
            'experience_cost' => 'required|max:3|integer',
            'description' => 'required|max:65535',
            'system' => 'required|max:65535',
            'book_id' => 'required|max:20|integer|exists:books,id'
        ]);

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
     * Update talent
     */
    public function updateTalent(Request $request, Talent $talent)
    {
        $validated = $request->validate([
            'talent.name' => 'required|max:255|unique:talent,name,' . $talent->id,
            'talent.experience_cost' => 'required|max:99|min:-99|integer',
            'talent.categories' => 'array',
            'talent.categories.*' => 'integer',
            'talent.requirements' => 'array',
            'talent.requirements.*' => 'integer',
            'talent.required_talents' => 'array',
            'talent.required_talents.*' => 'integer',
            'talent.description' => 'required|max:65535',
            'talent.system' => 'required|max:65535',
            'talent.book_id' => 'required|max:20|integer|exists:books,id',
            'talent.traits' => 'array',
            'talent.traits.*' => 'integer'
        ]);

        $talent->update($validated);

        // Delete all the associated data
        $t = Talent::find($talent->id);

        // Get all the associated data
        $categories = $request->collect('talent.categories')->toArray();
        $requirements = $request->collect('talent.requirements')->toArray();
        $required_talents = $request->collect('talent.required_talents')->toArray();
        $traits = $request->collect('talent.talent_traits')->toArray();

        // Create the new associated data
        $t->talent_categories()->sync($categories);
        $t->talent_requirements()->sync($requirements);
        $t->required_talents()->sync($required_talents);
        $t->talent_traits()->sync($traits);


        return new TalentResource($talent);
    }

    /**
     * Display talents by genre name.
     */
    public function getTalentsByGenre($genre_input)
    {
        // Make new genre controller
        $genre_controller = new GenreController;

        // Get genres using genre controller function showName
        $genre = $genre_controller->showName($genre_input);

        // Check if there is no error, else return genre response.
        if ($genre->getStatusCode() !== 200) {
            return $genre;
        }

        // get all books with the given genre id
        $book_ids = Book::all()->where('genre_id', $genre->getData()->id)->pluck('id');

        // get all talents from the books with the given genre id
        $talents = Talent::all()->whereIn('book_id', $book_ids);

        // return the array with the talent resource
        return TalentResource::collection($talents);
    }

    /**
     * Display talent by genre name and talent id.
     */
    public function getTalentByGenre($genre_input, Talent $talent)
    {
        // Make new genre controller
        $genre_controller = new GenreController;

        // Get genres using genre controller function showName
        $genre = $genre_controller->showName($genre_input);

        // Check if there is no error, else return genre response.
        if ($genre->getStatusCode() !== 200) {
            return $genre;
        }

        // Get the book id the talent is in
        $book_id = [$talent->book_id];

        // Get the genre_id of the book
        $genre_id = Book::whereIn('id', $book_id)->get()->pluck('genre_id');

        if ($genre_id[0] === $genre->getData()->id) {
            return new TalentResource($talent);
        }
        return response()->json(['message' => 'could not find talent in given genre'], 404);
    }
}
