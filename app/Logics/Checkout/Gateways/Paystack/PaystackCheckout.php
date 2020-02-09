<?php

namespace App\Logics\Checkout\Gateways\Paystack;

use App\Logics\Checkout\CheckoutGateway;
use App\Services\GladePay\PaystackCheckout as PaystackCheckoutService;

class PaystackCheckout extends CheckoutGateway
{
    private $paystackService;

    public function __construct(PaystackCheckoutService $paystackService)
    {
        $this->paystackService = $paystackService;
    }

    public function gatewayName()
    {
        return 'Paystack';
    }

    public function execute(string $email, float $amount)
    {
        return $this->paystackService->execute($email, $amount);
    }

    public function handleError($error)
    {
        abort(HTTP_BAD_REQUEST, 'Error Buying Coin');
    }

    public function handleSuccess($response)
    {
        return [
            "url" => $response['data']['data']['authorization_url'],
            "reference" => $response['data']['data']['reference'],
            "access_code" => $response['data']['data']['access_code'],
            "platform" => $this->gatewayName()
        ];
    }
}
