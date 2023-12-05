<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentCategory extends Model
{
    use HasFactory;

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
