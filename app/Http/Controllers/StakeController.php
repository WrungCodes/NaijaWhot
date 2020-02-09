<?php

namespace App\Http\Controllers;

use App\Helpers\Find;
use App\Http\Actions\WalletActions\PayWinner;
use App\Http\Actions\WalletActions\StakeAction;
use App\Http\Requests\Stake as RequestsStake;
use App\Stake;
use Illuminate\Http\Request;

class StakeController extends Controller
{

    public function stake(Request $request)
    {
        return ['balance' => (new StakeAction($request))->execute()];
    }

    public function payWinner(Request $request)
    {
        return ['balance' => (new PayWinner($request))->execute()];
    }

    public function validateStake(Request $request)
    {
        $user = Find::findAuthUser($request);

        $stakeType = Find::GetStakeTypeWithUid($request->uid);

        $initialBalance = $user->profile->naira_balance;

        if ($stakeType->stake_amount > $initialBalance) {
            abort(HTTP_PAYMENT_REQUIRED, "insufficient fund");
        }

        return ['status' => true];
    }
}
