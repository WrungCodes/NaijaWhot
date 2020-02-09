<?php

namespace App\Logics\Checkout;


abstract class CheckoutGateway
{
    abstract protected function gatewayName();

    abstract protected function execute(string $email, float $amount);

    abstract protected function handleError($error);

    abstract protected function handleSuccess($response);

    public function handleNoResponse()
    {
        abort(HTTP_BAD_REQUEST, 'Error Buying Coin');
    }
}
