<?php

namespace App\Http\Actions\WalletActions;

use App\CoinDeal;
use App\NairaHistory;
use App\Traits\WalletTrait;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessWebhook
{
    use WalletTrait;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        return $this->processCredit();
    }

    public function processCredit()
    {
        $signature = (isset($this->request->header()['x-paystack-signature'][0]) ? $this->request->header()['x-paystack-signature'][0] : null);

        $transaction_ref = $this->request['data']['reference'];

        $status = $this->request['data']['status'];

        if (!$signature) {
            exit();
        }

        if ($signature !== hash_hmac('sha512', file_get_contents('php://input'), config('paystack.test_sk'))) {
            exit();
        }

        if ($status !== "success") {
            exit();
        }

        DB::beginTransaction();

        $transaction = Transaction::where(['transaction_ref' =>  $transaction_ref, 'status' => Transaction::TRANSACTION_PENDING])->first();

        $quantity = $this->request['data']['amount'];

        $user = User::where(['id' => $transaction->user_id])->first();

        $currentBalance = $this->CreditNaira($user, $quantity, NairaHistory::DEBIT_TYPE);

        $transaction->update([
            'status' => Transaction::TRANSACTION_SUCCESSFUL
        ]);

        DB::commit();

        return ['status' => 'success'];
    }
}
