<?php

namespace App\Http\Actions\WalletActions;

use App\Helpers\Find;
use App\Logics\Checkout\Checkout;
use App\Logics\Checkout\Gateways\Paystack\PaystackCheckout;
use App\Services\Paystack\PaystackCheckout as PaystackCheckoutService;
use App\Traits\InventoryTrait;
use App\Traits\WalletTrait;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\DB;

class Deposit
{

    protected $user;

    protected $amount;


    public function __construct(User $user, string $amount)
    {
        $this->user = $user;
        $this->amount = $amount;
    }

    public function execute()
    {
        return $this->processBuy();
    }

    public function processBuy()
    {
        $response = (new Checkout(new PaystackCheckout(new PaystackCheckoutService())))
            ->process($this->user->email,  $this->amount);

        $this->user->transactions()->create([
            'amount' => $this->amount,
            'user_id' => $this->user->id,
            'platform' => $response['platform'],
            'transaction_type' => Transaction::TRANSACTION_TYPE_NAIRA,
            'transaction_ref' => $response['reference'],
            'access_code' =>  $response['access_code'],
            'status' => Transaction::TRANSACTION_PENDING
        ]);

        return $response;
    }
}
