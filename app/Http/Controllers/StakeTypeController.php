<?php

namespace App\Http\Controllers;

use App\Http\Resources\StakeType as ResourcesStakeType;
use App\StakeType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StakeTypeController extends Controller
{
    public function create(Request $request)
    {
        return new ResourcesStakeType(StakeType::create([
            'uid' => (string) Str::random(10),
            'description' => $request->description,
            'number_of_players' => $request->number_of_players,
            'stake_amount' => $request->stake_amount,
            'win_amount' => $request->win_amount,
        ]));
    }

    public function get()
    {
        return ['stake_type' =>  ResourcesStakeType::collection(StakeType::all())];
    }
}
