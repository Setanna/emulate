<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Talent extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'id',
        'name',
        'experience_cost',
        'description',
        'system',
        'book_id'
    ];

    /**
     * Get the talent requirements that the talent has through TalentRequirement
     */
    public function talent_requirements()
    {
        return $this->hasManyThrough(
            'App\Models\Requirement',
            'App\Models\TalentRequirement',
            'talent_id',
            'id',
            'id',
            'requirement_id'
        );
    }

    /**
     * Get the required talents that the talent has through RequiredTalent
     */
    public function required_talent()
    {
        return $this->hasManyThrough(
            'App\Models\Talent',
            'App\Models\RequiredTalent',
            'talent_id',
            'id',
            'id',
            'required_talent_id'
        );
    }

    /**
     * Get the categories that the talent has through TalentCategory
     */
    public function talent_categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the traits that the talent has through TalentCategory
     */
    public function talent_traits()
    {
        return $this->hasManyThrough(
            'App\Models\TraitModel',
            'App\Models\TalentTrait',
            'talent_id',
            'id',
            'id',
            'trait_id'
        );
    }

    /**
     * Get the book the talent belongs to
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
