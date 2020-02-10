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
            'previous_amount' => number_format($this->initial_amount, 2),
            'final_amount' => number_format($this->final_amount, 2),
            'amount' => number_format($this->amount, 2),
            'type' => $this->type,
            'created_at' => $this->created_at,
        ];
    }
}
