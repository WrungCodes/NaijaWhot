<?php

namespace App\Logics\Payment\Interfaces;

use App\Http\Requests\Transfer as RequestsTransfer;

interface ITransfer
{
    public function transfer(RequestsTransfer $request);
}
