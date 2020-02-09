<?php

namespace App\Logics\Payment\Gateways\GladePay;

use App\Http\Requests\Transfer;
use App\Logics\Payment\Transfer\PaymentTransferGateway;

class GladePayTransfer extends PaymentTransferGateway
{
    public function __construct(Transfer $request)
    {
    }
}
