<?php

namespace App\Logics\Payment;


abstract class PaymentGateway
{
    abstract protected function gatewayName();

    abstract protected function amount();

    abstract protected function handleError($error);

    abstract protected function handleSuccess($response);

    public function handleNoResponse()
    {
        return;
    }
}
