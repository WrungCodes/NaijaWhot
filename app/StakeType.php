<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StakeType extends Model
{
    protected $fillable = [
        'stake_amount', 'win_amount', 'uid', 'number_of_players', 'description'
    ];

    protected $hidden = [
        'id'
    ];

    protected $casts = [
        'win_amount' => 'float',
        'stake_amount' => 'float',
    ];
}
