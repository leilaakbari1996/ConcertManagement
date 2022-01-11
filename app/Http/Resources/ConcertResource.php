<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConcertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this -> id,
            'title' => $this->title,
            'artist' => new ArtistResource($this->artist),
            'description' => $this -> description,
            'is_published' => $this -> is_published,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at
        ];
    }
}
