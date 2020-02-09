<?php

namespace App\Logics\Payment\Transfer;

use App\Http\Requests\Transfer as RequestsTransfer;
use App\Logics\Payment\Interfaces\ITransfer;
use App\Logics\Payment\Transfer\PaymentTransferGateway;

class PaymentTransfer implements ITransfer
{
    protected $paymentGateway;

    public function __construct(PaymentTransferGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function transfer()
    {
        $response = $this->paymentGateway->transfer();
    }
}
