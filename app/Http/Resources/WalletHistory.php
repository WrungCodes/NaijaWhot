<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletHistory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'previous_amount' => $this->initial_amount,
            'final_amount' => $this->final_amount,
            'amount' => $this->amount,
            'type' => $this->type,
            'created_at' => $this->created_at,
        ];
    }
}
