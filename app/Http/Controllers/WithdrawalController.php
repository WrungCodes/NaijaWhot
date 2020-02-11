<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Helpers\Find;
use App\Http\Actions\WalletActions\Withdraw;
use App\Http\Requests\WithdrawalRequest;
use App\Http\Resources\BankResource;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function withdraw(WithdrawalRequest $request)
    {
        return (new Withdraw(
            Find::findAuthUser($request),
            $request->account_number,
            $request->bank_uid,
            $request->amount
        ))
            ->execute();
    }

    public function banks()
    {
        dd(Bank::all());
        return BankResource::collection(Bank::all());
    }
}
