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
        return $this->belongsToMany(Requirement::class);
    }

    /**
     * Get the required talents that the talent has through RequiredTalent
     */
    public function required_talents()
    {
        return $this->belongsToMany(Talent::class, 'required_talent', 'talent_id', 'required_talent_id');
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
        return $this->belongsToMany(TraitModel::class);
    }

    /**
     * Get the book the talent belongs to
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
