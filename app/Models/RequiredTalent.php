<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequiredTalent extends Model
{
    use HasFactory;

    protected $fillable = [
        'talent_id',
        'required_talent_id'
    ];

    /**
     * Get the talent that the required talent belongs to
     */
    public function talent()
    {
        return $this->belongsTo(Talent::class, 'talent_id', 'id');
    }

    /**
     * Get the reqquired talent that the required talent belongs to
     */
    public function required_talent()
    {
        return $this->belongsTo(Talent::class, 'required_talent_id', 'id');
    }
}
