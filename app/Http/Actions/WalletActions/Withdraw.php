<?php

namespace App\Http\Actions\WalletActions;

use App\Classes\BankDetails;
use App\Helpers\Find;
use App\Logics\Payment\Gateways\Paystack\PaystackPayment;
use App\Logics\Payment\Payment;
use App\NairaHistory;
use App\Services\Paystack\PaystackPayment as PaystackPaystackPayment;
use App\Traits\WalletTrait;
use App\Transaction;
use App\User;
use App\Withdrawal;

class Withdraw
{

    use WalletTrait;

    private $user;
    private $amount;
    private $bankDetails;

    public function __construct(User $user, string $accountNumber, string $bankUid, float $amount)
    {
        $this->user = $user;
        $this->amount = $amount;

        $bank = Find::GetBankWithUid($bankUid);
        $this->bankDetails = new BankDetails($accountNumber, $bank->name, $bank->code);
    }

    public function execute()
    {
        return $this->logWithdrawal();
    }

    private function logWithdrawal()
    {
        // $response = (new Payment(new PaystackPayment(new PaystackPaystackPayment(), $this->user)))
        //     ->pay($this->bankDetails, $this->amount);

        $currentBalance = $this->DebitNaira($this->user, $this->amount, NairaHistory::WITHDRAWAL_TYPE);

        // $transaction = $this->user->transactions()->create([
        //     'amount' => $this->amount,
        //     'user_id' => $this->user->id,
        //     'platform' => $response['platform'],
        //     'transaction_type' => Transaction::TRANSACTION_TYPE_NAIRA,
        //     'transaction_ref' => $response['reference'],
        //     'access_code' =>  $response['access_code'],
        //     'status' => Transaction::TRANSACTION_PENDING
        // ]);
        // return $currentBalance;

        // 'account_number', 'bank_name', 'amount', 'status'

        $withdrawal = $this->user->withdrawals()->create([
            'account_number' => $this->bankDetails->accountNumber,
            'bank_name' =>  $this->bankDetails->bankName,
            'amount' => $this->amount,
            'status' => Transaction::TRANSACTION_PENDING
        ]);

        return $withdrawal;
    }
}
