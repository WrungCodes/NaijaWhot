<?php

namespace App\Services\GladePay;

use App\Services\Service;

class PaystackCheckout extends Service
{
    public function baseUri()
    {
        return config('paystack.base_url');
    }

    public function execute($email, $amount)
    {
        $url = "/transaction/initialize";

        return $this->post($url, [
            'json' => [
                'amount' => $amount * 100,
                'email' => $email,
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . config('paystack.test_sk'),
                "cache-control" => 'no-cache',
                'Content-Type'  => 'application/json'
            ]
        ]);
    }
}
