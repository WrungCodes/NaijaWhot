<?php

namespace App\Services\Paystack;

use App\Services\Service;

class PaystackPayment extends Service
{
    public function baseUri()
    {
        return config('paystack.base_url');
    }

    private function GetHeaders()
    {
        return  [
            'Authorization' => 'Bearer ' . config('paystack.test_sk'),
            "cache-control" => 'no-cache',
            'Content-Type'  => 'application/json'
        ];
    }

    public function createRecipient($user, $accountNumber, $bankCode)
    {
        $url = "/transferrecipient";

        return $this->post($url, [
            'json' => [
                'type' => 'nuban',
                'name' => $user->username,
                'description' => config('app.name') . " user " . $user->username,
                'account_number' => $accountNumber,
                'bank_code' => $bankCode,
                'currency' => 'NGN',
                "metadata" => [
                    "player_name" => $user->username,
                    "player_email" => $user->email
                ]
            ],
            'headers' => $this->GetHeaders()
        ]);
    }

    public function disableOtp()
    {
        $url = "/transfer/disable_otp";

        return $this->post($url, [
            'headers' => $this->GetHeaders()
        ]);
    }

    public function InitializeTransfer($amount, $recipient)
    {
        $url = "/transfer";

        return $this->post($url, [
            'json' => [
                'source' => 'balance',
                'amount' => $amount * 100,
                'source' => 'balance',
                'currency' => 'NGN',
                'recipient' => $recipient,
                'reason' => "Withdrawal from " . config('app.name')
            ],
            'headers' => $this->GetHeaders()
        ]);
    }

    public function VerifyTransfer($reference)
    {
        $url = "/transfer/verify/" . $reference;

        return $this->get($url, [
            'headers' => $this->GetHeaders()
        ]);
    }
}
