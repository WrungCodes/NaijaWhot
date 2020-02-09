<?php

namespace App\Helpers;

use App\CoinDeal;
use App\Item;
use App\StakeType;
use App\User;

class Find
{
    public static function findUser($key, $value)
    {
        return User::where([$key => $value])->first();
    }

    public static function findAuthUser($request)
    {
        return $request->user;
    }

    public static function GetStakeTypeWithUid(string $uid)
    {
        return StakeType::where(['uid' => $uid])->first();
    }
}
