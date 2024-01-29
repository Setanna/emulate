<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Type extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'system',
    ];

    /**
     * Get the races that the type has through race_senses
     */
    public function races()
    {
        return $this->hasManyThrough(
            'App\Models\Race',
            'App\Models\RaceType',
            'type_id',
            'id',
            'id',
            'race_id'
        );
    }
}
