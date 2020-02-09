<?php

namespace App\Logics\Payment\Transfer;

use App\Logics\Payment\PaymentGateway;

abstract class PaymentTransferGateway
{
    abstract protected function gatewayName();

    abstract protected function amount();

    abstract protected function accountNumber();

    abstract protected function bankName();

    abstract protected function bankCode();

    abstract protected function transfer();

    abstract protected function handleError($error);

    abstract protected function handleSuccess($response);

    public function handleNoResponse()
    {
        return;
    }
}
