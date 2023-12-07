<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
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
        $search_results = $search_results->merge(Book::search($query)->take(10)->get());
        $search_results = $search_results->merge(Rule::search($query)->take(10)->get());
        $search_results = $search_results->merge(Talent::search($query)->take(10)->get());
        $search_results = $search_results->merge(RequiredTalent::search($query)->take(10)->get());
        $search_results = $search_results->merge(TalentRequirement::search($query)->take(10)->get());
        $search_results = $search_results->merge(Requirement::search($query)->take(10)->get());
        $search_results = $search_results->merge(TalentCategory::search($query)->take(10)->get());
        $search_results = $search_results->merge(Category::search($query)->take(10)->get());
        $search_results = $search_results->merge(TraitModel::search($query)->take(10)->get());
        return $search_results;

    }
}
