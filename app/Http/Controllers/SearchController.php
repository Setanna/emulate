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

class SearchController extends Controller
{
    /**
     * Display the specified resource.
     *
     */
    public function search($query)
    {
        $search_results = new \Illuminate\Database\Eloquent\Collection; //Create empty collection
        $search_results = [
            'books' => Book::search($query)->take(10)->get(),
            'rules' => Rule::search($query)->take(10)->get(),
            'races' => Race::search($query)->take(10)->get(),
            'talents' => Talent::search($query)->take(10)->get(),
            'requirements' => Requirement::search($query)->take(10)->get(),
            'categories' => Category::search($query)->take(10)->get(),
            'traits' => TraitModel::search($query)->take(10)->get()
        ];
        return $search_results;

    }
}
