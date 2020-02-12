<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalResource extends JsonResource
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
            'account_number' => $this->account_number,
            'bank_name' =>  $this->bank_name,
            'amount' => $this->amount,
            'status' => $this->status,
            'created_at' => $this->created_at
        ];
    }
}
