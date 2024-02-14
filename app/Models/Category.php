<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'system'
    ];

    /**
     * Get the talents that have the category through TalentCategory
     */
    public function talent_categories()
    {

        return $this->belongsToMany(Talent::class);
    }
}
