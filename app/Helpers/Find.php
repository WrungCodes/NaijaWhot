<?php

namespace App\Helpers;

use App\Bank;
use App\CoinDeal;
use App\Item;
use App\StakeType;
use App\User;
use App\Withdrawal;

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

    public static function GetBankWithUid(string $uid)
    {
        return Bank::where(['uid' => $uid])->first();
    }

    public static function GetWithdrawalWithId(int $id)
    {
        return Withdrawal::where(['id' => $id])->first();
    }
}
