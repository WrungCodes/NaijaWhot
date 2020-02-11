<?php

namespace App\Logics\Payment;

use App\Classes\BankDetails;


abstract class PaymentGateway
{
    abstract protected function gatewayName();

    abstract protected function pay(BankDetails $bankDetails, float $amount);

    abstract protected function handleError($error);

    abstract protected function handleSuccess($response);

    public function handleNoResponse()
    {
        abort(HTTP_BAD_REQUEST, 'Payment Error');
    }
}
