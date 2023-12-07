<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Rule extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'text',
        'book_id'
    ];

    /**
     * Get the book the rule belongs to
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
