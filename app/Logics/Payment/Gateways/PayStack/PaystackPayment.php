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

    public function gatewayName()
    {
        return 'paystack';
    }

    public function pay(BankDetails $bankDetails, float $amount)
    {
        $createReciepientResponse = $this->paystackPaymentService
            ->createRecipient($this->user, $bankDetails->accountNumber, $bankDetails->bankCode);

        if (!$createReciepientResponse) {
            return $createReciepientResponse;
        }

        if ($createReciepientResponse['status'] != 201) {
            return $createReciepientResponse;
        }
        $reciepentCode = $createReciepientResponse['data']['data']['recipient_code'];

        return $this->paystackPaymentService->InitializeTransfer($amount, $reciepentCode);
    }

    public function handleError($error)
    {
        if ($error['status'] == 400 && $error['error']['message'] == 'Cannot resolve account') {
            abort(HTTP_PRECONDITION_FAILED, 'Invalid Account Number');
        }

        abort(HTTP_BAD_REQUEST, 'Error Occured While Proccessing Try Again Later');
    }

    public function handleSuccess($response)
    {
        $response = $response['data'];
    }
}
