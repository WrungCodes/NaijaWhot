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
            'stake_amount' => number_format($this->stake_amount, 2),
            'win_amount' => number_format($this->win_amount, 2)
        ];
    }
}
