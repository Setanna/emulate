<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use App\Models\TraitModel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display the specified resource.
     *
     */
    public function search($search)
    {
        $talents = ['talents' =>Talent::where('name', 'like', '%'.$search.'%')
            ->orWhere('description','like', '%'.$search.'%')
            ->get()];

        $traits = ['traits' => TraitModel::where('name', 'like', '%'.$search.'%')
            ->orWhere('description','like', '%'.$search.'%')
            ->get()];


        if(count($traits["traits"]) < 1 && count($talents["talents"]) < 1){
            return '{"error": "No search results"}';
        }
        return $traits + $talents;
    }

}
