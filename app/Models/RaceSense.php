<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class RaceSense extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'race_id',
        'sense_id'
    ];

    /**
     * Get the race the sense belongs to
     */
    public function race()
    {
        return $this->belongsTo(Race::class, 'race_id', 'id');
    }

    /**
     * Get the sense the race belongs to
     */
    public function sense()
    {
        return $this->belongsTo(Sense::class, 'sense_id', 'id');
    }
}
