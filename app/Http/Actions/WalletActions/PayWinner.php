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

class PayWinner
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

        $currentBalance = $this->CreditNaira($user, $stakeType->win_amount, NairaHistory::WIN_TYPE);

        DB::commit();

        return $currentBalance;
    }
}
