<?php

namespace App\Logics\Payment\Gateways\Paystack;

use App\Classes\BankDetails;
use App\Logics\Payment\PaymentGateway;
use App\Services\Paystack\PaystackPayment as PaystackPaystackPayment;
use App\User;

class PaystackPayment extends PaymentGateway
{
    private $paystackPaymentService;
    private $user;

    public function __construct(PaystackPaystackPayment $paystackPaymentService, User $user)
    {
        $this->paystackPaymentService = $paystackPaymentService;
        $this->user = $user;
    }

    public function pay(BankDetails $bankDetails, float $amount)
    {
        $createReciepientResponse = $this->paystackPaymentService
            ->createRecipient($this->user, $bankDetails->accountNumber, $bankDetails->bankCode);

        if (!$createReciepientResponse) {
            return $createReciepientResponse;
        }

        if ($createReciepientResponse['status'] != true) {
            return $createReciepientResponse;
        }

        $reciepentCode = $createReciepientResponse['data']['recipient_code'];

        return $this->paystackPaymentService->InitializeTransfer($amount, $reciepentCode);
    }

    public function handleError($error)
    {
    }

    public function handleSuccess($response)
    {
    }
}
