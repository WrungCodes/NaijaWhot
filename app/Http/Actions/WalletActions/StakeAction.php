<?php

namespace App\Http\Actions\WalletActions;

use App\CoinDeal;
use App\Helpers\Find;
use App\NairaHistory;
use App\Stake;
use App\Traits\WalletTrait;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StakeAction
{
    use WalletTrait;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        return $this->processStake();
    }

    private function processStake()
    {
        $user = Find::findAuthUser($this->request);

        $stakeType = Find::GetStakeTypeWithUid($this->request->uid);

        DB::beginTransaction();

        $currentBalance = $this->DebitNaira($user, $stakeType->stake_amount, NairaHistory::STAKE_TYPE);

        $stake = $user->stakes()->create([
            'amount' => $stakeType->stake_amount,
            'stake_type_uid' => $stakeType->uid,
            'status' => Stake::STAKE_SUCCESSFUL,
        ]);

        DB::commit();

        return $currentBalance;
    }
}
