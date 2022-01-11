<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class singleArtistResource extends JsonResource
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
            'full_name' => $this -> full_name,
            'avator' => $this->avator,
            'background' => $this->background,
            'category' => new CategoryResource($this->category)
        ];
    }
}
