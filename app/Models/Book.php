<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'genre_id',
        'publication_date'
    ];

    /**
     * Get the genre the book belongs to
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    /**
     * Get the talents the book has
     */
    public function talents()
    {
        return $this->hasMany(Talent::class, 'book_id', 'id');
    }
}
