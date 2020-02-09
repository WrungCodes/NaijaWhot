<?php

namespace App\Logics\Payment\Gateways\GladePay;

use App\Http\Requests\Checkout;
use App\Logics\Payment\Transfer\PaymentCheckoutGateway;

class PaystackCheckout extends PaymentCheckoutGateway
{
    private $gatewayName;

    private $amount;

    private $cardNo;

    private $expiryDate;

    private $pin;

    private $gladepayService;

    public function __construct(Checkout $request)
    {
        $this->gatewayName = "GladePay";

        $this->amount = $request->amount;

        $this->cardNo = $request->cardNo;

        $this->expiryDate = $request->expiryDate;

        $this->pin = $request->pin;
    }

    public function gatewayName()
    {
        return $this->gatewayName;
    }

    public function amount()
    {
        return $this->amount;
    }

    public function cardNo()
    {
        return $this->cardNo;
    }

    public function expiryDate()
    {
        return $this->expiryDate;
    }

    public function pin()
    {
        return $this->pin;
    }

    public function checkout()
    {
    }

    public function handleError($error)
    {
    }

    public function handleSuccess($response)
    {
    }
}
