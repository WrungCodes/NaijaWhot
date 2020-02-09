<?php

namespace App\Http\Controllers;

use App\Helpers\Find;
use App\Http\Resources\WalletHistory;
use App\NairaHistory;
use Illuminate\Http\Request;

class NairaHistoryController extends Controller
{
    public function getUser(Request $request)
    {
        return  ['history' => WalletHistory::collection(Find::findAuthUser($request)->nairaHistory)];
    }

    public function getAll(Request $request)
    {
        return ['history' => WalletHistory::collection(NairaHistory::all())];
    }
}
