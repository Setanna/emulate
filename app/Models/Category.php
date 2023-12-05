<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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
        return $this->hasManyThrough(
            'App\Models\Talent',
            'App\Models\TalentCategory',
            'category_id',
            'id',
            'id',
            'talent_id'
        );
    }
}
