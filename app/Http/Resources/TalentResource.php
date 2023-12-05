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
            'rank'                  => $this->rank,
            'description'           => $this->description,
            'system'                => $this->system,
            'book'                  => $this->book->name,
            'genre'                 => $this->book->genre->name,
            'talent_categories'     => $this->talent_categories->pluck('name'),
            'required_talents'      => $this->required_talent->pluck('name'),
            'requirements'          => $this->talent_requirements->pluck('name'),
            'traits'                => $this->talent_traits->pluck('name')
        ];
    }
}
