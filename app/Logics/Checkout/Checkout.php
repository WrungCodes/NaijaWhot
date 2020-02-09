<?php

namespace App\Logics\Checkout;


class Checkout
{
    public $checkoutGateway;

    public function __construct(CheckoutGateway $checkoutGateway)
    {
        $this->checkoutGateway = $checkoutGateway;
    }

    public function process(string $email, float $amount)
    {
        return $this->handleResponseStatus($this->checkoutGateway->execute($email, $amount));
    }

    private function handleResponseStatus($response)
    {
        if (!$response) {
            return $this->checkoutGateway->handleNoResponse();
        }

        if ($response["status"] == 0) {
            return $this->checkoutGateway->handleNoResponse();
        }

        if ($response['status'] == 200) {
            return $this->checkoutGateway->handleSuccess($response);
        }

        return $this->checkoutGateway->handleError($response);
    }
}
