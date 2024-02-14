<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/* Trait is reserved by php, so TraitModel is a necessary evil */
class TraitModel extends Model
{
    use Searchable, HasFactory;

    /* Makes laravel understand the table name is "traits" and not "trait_models" */
    protected $table = 'traits';

    protected $fillable = [
        'name',
        'description',
        'system'
    ];

    /**
     * Get the talents that has attribute through TalentRequirement
     */
    public function talent_traits()
    {
        return $this->belongsToMany(Talent::class);
    }
}
