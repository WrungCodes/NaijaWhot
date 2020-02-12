<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Helpers\Find;
use App\Http\Actions\WalletActions\ProcessWithdrawal;
use App\Http\Actions\WalletActions\Withdraw;
use App\Http\Requests\WithdrawalRequest;
use App\Http\Resources\BankResource;
use App\Http\Resources\WithdrawalResource;
use App\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function withdraw(WithdrawalRequest $request)
    {
        return ['balance' => (new Withdraw(
            Find::findAuthUser($request),
            $request->account_number,
            $request->bank_uid,
            $request->amount
        ))
            ->execute()];
    }

    public function getAllUserWithdrawals(Request $request)
    {
        return ['withdrawals' => WithdrawalResource::collection(Find::findAuthUser($request)->withdrawals)];
    }

    public function getAllWithdrawals()
    {
        return ['withdrawals' => WithdrawalResource::collection(Withdrawal::all())];
    }

    public function proccessWithdrawal(Request $request)
    {
        return new WithdrawalResource((new ProcessWithdrawal($request->id, $request->status))->execute());
    }

    public function banks()
    {
        return ['banks' => BankResource::collection(Bank::all())];
    }
}
