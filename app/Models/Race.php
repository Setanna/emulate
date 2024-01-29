<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Race extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'experience_cost',
        'hit_points',
        'book_id'
    ];

    /**
     * Get the senses that the race has through race_senses
     */
    public function senses()
    {
        return $this->hasManyThrough(
            'App\Models\Sense',
            'App\Models\RaceSense',
            'race_id',
            'id',
            'id',
            'sense_id'
        );
    }

    /**
     * Get the types that the race has through race_senses
     */
    public function types()
    {
        return $this->hasManyThrough(
            'App\Models\Type',
            'App\Models\RaceType',
            'race_id',
            'id',
            'id',
            'Type_id'
        );
    }

    /**
     * Get the book the race belongs to
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
