<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Race;
use App\Models\RequiredTalent;
use App\Models\Requirement;
use App\Models\Rule;
use App\Models\Talent;
use App\Models\TalentCategory;
use App\Models\TalentRequirement;
use App\Models\TraitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SearchController extends Controller
{
    /**
     * Display the first 10 of each relevant category.
     *
     */
    public function quickSearch($query)
    {
        $search_results = new \Illuminate\Database\Eloquent\Collection; //Create empty collection
        $search_results = [
            'rules' => Rule::search($query)->take(10)->get(),
            'races' => Race::search($query)->take(10)->get(),
            'talents' => Talent::search($query)->take(10)->get(),
            'requirements' => Requirement::search($query)->take(10)->get(),
            'categories' => Category::search($query)->take(10)->get(),
            'traits' => TraitModel::search($query)->take(10)->get()
        ];
        return $search_results;

    }

    /**
     * Display the first 10 of each relevant category in given genre.
     *
     */
    public function genreSearch($genre_input, $query)
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

        $search_results = new \Illuminate\Database\Eloquent\Collection; //Create empty collection
        $search_results = [
            'rules' => Rule::search($query)->take(10)->get()->whereIn('book_id', $book_ids),
            'races' => Race::search($query)->take(10)->get()->whereIn('book_id', $book_ids),
            'talents' => Talent::search($query)->take(10)->get()->whereIn('book_id', $book_ids)
        ];
        return $search_results;

    }
}
