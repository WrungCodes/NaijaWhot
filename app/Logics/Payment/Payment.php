<?php

namespace App\Logics\Payment;

use App\Classes\BankDetails;
use App\Logics\Payment\PaymentGateway;

class Payment
{
    protected $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function pay(BankDetails $bankDetails, float $amount)
    {
        return $this->handleResponseStatus($this->paymentGateway->pay($bankDetails, $amount));
    }

    private function handleResponseStatus($response)
    {
        dd($response);
        if (!$response) {
            return $this->paymentGateway->handleNoResponse();
        }

        if ($response["status"] == 0) {
            return $this->paymentGateway->handleNoResponse();
        }

        if ($response['status'] == 200) {
            return $this->paymentGateway->handleSuccess($response);
        }

        return $this->paymentGateway->handleError($response);
    }
}
