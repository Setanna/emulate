<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class RaceType extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'race_id',
        'type_id'
    ];

    /**
     * Get the race the type belongs to
     */
    public function race()
    {
        return $this->belongsTo(Race::class, 'race_id', 'id');
    }

    /**
     * Get the type the race belongs to
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
