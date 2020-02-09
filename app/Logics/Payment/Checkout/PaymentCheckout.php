<?php

namespace App\Logics\Payment\Transfer;

use App\Http\Requests\Checkout;
use App\Logics\Payment\Interfaces\ICheckout;
use App\Logics\Payment\Transfer\PaymentCheckoutGateway;

class PaymentCheckout implements ICheckout
{
    protected $paymentGateway;

    public function __construct(PaymentCheckoutGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function checkout()
    {
        $response = $this->paymentGateway->checkout();
    }
}
