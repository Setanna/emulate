<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TalentCategory extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'talent_id',
        'category_id'
    ];

    /**
     * Get the genre the book belongs to
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the genre the book belongs to
     */
    public function talent()
    {
        return $this->belongsTo(Talent::class, 'talent_id', 'id');
    }
}
