<?php

namespace App\Services\GladePay;

use App\Services\Service;

class GladePayTransfer extends Service
{
    public function baseUri()
    {
        return config('gladepay.base_url');
    }

    public function execute()
    {
        return $this->post('', [
            'json' => [
                'account_number' => '',
                'account_bank' => '',
                'seckey' => config('gladepay.secretKey'),
            ],
            'headers' => [
                'Authorization' => '',
                'Signature' =>   '',
                'Content-Type'  => 'application/json'
            ]
        ]);
    }
}
