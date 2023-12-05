<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentTrait extends Model
{
    use HasFactory;

    protected $fillable = [
        'talent_id',
        'trait_id'
    ];

    /**
     * Get the trait the talent trait belongs to
     */
    public function trait()
    {
        return $this->belongsTo(TraitModel::class, 'trait_id', 'id');
    }

    /**
     * Get the talent that the talent trait belongs to
     */
    public function talent()
    {
        return $this->belongsTo(Talent::class, 'talent_id', 'id');
    }
}
