<?php

namespace App\Http\Resources;

use App\Models\RequiredTalent;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TalentResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'experience_cost'       => $this->experience_cost,
            'description'           => $this->description,
            'system'                => $this->system,
            'book'                  => $this->book->name,
            'genre'                 => $this->book->genre->name,
            'categories'            => $this->talent_categories,
            'required_talents'      => $this->required_talent,
            'requirements'          => $this->talent_requirements,
            'traits'                => $this->talent_traits
        ];
    }
}
