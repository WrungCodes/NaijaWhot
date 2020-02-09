<?php

namespace App\Traits;

use App\CoinHistory;
use App\NairaHistory;
use App\User;

trait WalletTrait
{
    public function DebitNaira(User $user, float $price, $type)
    {
        $initialBalance = $user->profile->naira_balance;

        if (!$this->balanceIsEnough($initialBalance, $price)) {
            abort(HTTP_PAYMENT_REQUIRED, "insufficient fund");
        }

        $currentBalance = $initialBalance - $price;

        $user->profile()->update([
            'naira_balance' => $currentBalance
        ]);

        $this->CreateNairaHistory($initialBalance, $currentBalance, $price, $user, $type);

        return $currentBalance;
    }

    public function CreditNaira(User $user, float $price, string $type)
    {
        $initialBalance = $user->profile->naira_balance;

        $currentBalance = $initialBalance + $price;

        $user->profile()->update([
            'naira_balance' => $currentBalance
        ]);

        $this->CreateNairaHistory($initialBalance, $currentBalance, $price, $user, $type);

        return $currentBalance;
    }

    private function balanceIsEnough($balance, $amount): bool
    {
        if ($balance < $amount) {
            return false;
        }
        return true;
    }

    private function CreateNairaHistory(float $intitialAmount, float $finalAmount, float $price, User $user, string $type)
    {
        $user->nairaHistory()->create([
            'initial_amount' => $intitialAmount,
            'final_amount' => $finalAmount,
            'type' => $type,
            'amount' => $price
        ]);
    }
}
