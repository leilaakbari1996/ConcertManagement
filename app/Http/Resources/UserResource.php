<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)//$request => we want convert to $request to a array.
    {
        return [
            'id' => $this->id,
            'role' =>$this->role->title,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
