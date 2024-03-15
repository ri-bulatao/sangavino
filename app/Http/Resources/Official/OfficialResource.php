<?php

namespace App\Http\Resources\Official;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficialResource extends JsonResource
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
            'id' => $this->id,
            'avatar' => $this->avatar_profile,
            'name' => $this->name,
            'position' => $this->position,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}