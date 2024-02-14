<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class RequiredTalent extends Model
{
    use Searchable, HasFactory;

    protected $fillable = [
        'talent_id',
        'required_talent_id'
    ];

    /**
     * Get the reqquired talent that the required talent belongs to
     */
    public function required_talents()
    {
        return $this->belongsToMany(Talent::class);
    }
}
