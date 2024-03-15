<?php

namespace App\Http\Resources\Resident;

use Illuminate\Http\Resources\Json\JsonResource;

class ResidentResource extends JsonResource
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
            'name' => $this->full_name,
            'age' => getAge($this->birth_date),
            'gender' => $this->gender,
            'purok' => $this->purok->name,
            'contact' => $this->contact,
            'email' => $this->user?->email,
            'is_voter' => $this->is_voter,
            'created_at' => $this->created_at,
        ];
    }
}