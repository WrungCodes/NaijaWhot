<?php

namespace App\Http\Actions\WalletActions;

use App\Helpers\Find;
use App\NairaHistory;
use App\Traits\WalletTrait;
use App\Transaction;

class ProcessWithdrawal
{
    use WalletTrait;

    private $withdrawal;
    private $status;

    public function __construct(int $id, string $status)
    {
        $this->withdrawal = Find::GetWithdrawalWithId($id);
        $this->status = $status;
    }

    public function execute()
    {
        return $this->processWithdrawal();
    }

    private function processWithdrawal()
    {
        $status = $this->status == 'successful' ? Transaction::TRANSACTION_SUCCESSFUL : Transaction::TRANSACTION_FAILED;

        $withdrawal = $this->withdrawal->update([
            'status' => $status
        ]);

        if ($this->status !== 'successful') {
            $this->CreditNaira($this->user, $this->amount, NairaHistory::REFUND_TYPE);
        }

        return $withdrawal;
    }
}
