<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StakeType extends JsonResource
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
            'uid' => $this->uid,
            'number_of_players' => $this->number_of_players,
            'stake_amount' => $this->stake_amount,
            'win_amount' => $this->win_amount
        ];
    }
}
