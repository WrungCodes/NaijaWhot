<?php

namespace App\Logics\Payment\Transfer;

use App\Logics\Payment\PaymentGateway;

abstract class PaymentCheckoutGateway
{
    abstract protected function gatewayName();

    // abstract protected function amount();

    // abstract protected function cardNo();

    // abstract protected function expiryDate();

    // abstract protected function pin();

    abstract protected function checkout();

    abstract protected function handleError($error);

    abstract protected function handleSuccess($response);

    public function handleNoResponse()
    {
        return;
    }
}
