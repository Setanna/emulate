<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Requirement extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];


    public function talent_requirements()
    {
        return $this->hasManyThrough(
            'App\Models\Talent',
            'App\Models\TalentRequirement',
            'requirement_id',
            'id',
            'id',
            'talent_id'
        );
    }

}
