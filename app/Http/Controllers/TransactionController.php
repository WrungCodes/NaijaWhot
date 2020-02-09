<?php

namespace App\Http\Controllers;

use App\Helpers\Find;
use App\Http\Actions\WalletActions\ProcessWebhook;
use App\Http\Resources\Transaction as ResourcesTransaction;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function getAll()
    {
        return Transaction::all();
    }

    public function get(Request $request)
    {
        return ResourcesTransaction::collection(Find::findAuthUser($request)->transactions);
    }

    public function paystackWebhook(Request $request)
    {
        return (new ProcessWebhook($request))->execute();
    }
}
