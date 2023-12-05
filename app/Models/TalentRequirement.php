<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'talent_id',
        'requirement_id'
    ];

    /**
     * Get the requirement the talent requirement belongs to
     */
    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'requirement_id', 'id');
    }

    /**
     * Get the talent reqiurement belongs to
     */
    public function talent()
    {
        return $this->belongsTo(Talent::class, 'talent_id', 'id');
    }

}
