<?php

namespace App\Http\Resources;

use App\Models\SeatClass;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleSeatClassResource extends JsonResource
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
            'id' => $this ->id,
            'title' => $this->title,
            'cost' => $this->pivot->cost,
            'count' => $this->pivot->count
        ];
    }
}
