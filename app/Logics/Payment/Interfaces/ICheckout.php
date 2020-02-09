<?php

namespace App\Logics\Payment\Interfaces;

use App\Http\Requests\Checkout as RequestsCheckout;

interface ICheckout
{
    public function checkout(RequestsCheckout $request);
}
