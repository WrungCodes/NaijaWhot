<?php

namespace App\Http\Controllers;

use App\Helpers\Find;
use App\Http\Actions\WalletActions\Deposit as WalletActionsDeposit;
use Illuminate\Http\Request;

class Deposit extends Controller
{
    public function deposit(Request $request)
    {
        return (new WalletActionsDeposit(Find::findAuthUser($request),  $request->amount))->execute();
    }
}
