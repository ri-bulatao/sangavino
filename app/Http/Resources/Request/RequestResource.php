<?php

namespace App\Http\Resources\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'paypal_transaction_id' => $this->paypal_transaction_id,
            'resident' => $this->user->resident->full_name,
            'service' => $this->service->name,
            'purpose' => $this->purpose,
            'status' => $this->status,
            'remark' => $this->remark,
            'created_at' => $this->created_at,
        ];
    }
}