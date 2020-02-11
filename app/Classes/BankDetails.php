<?php

namespace App\Classes;

class BankDetails
{
    public $accountNumber;

    public $bankName;

    public $bankCode;

    public function __construct($accountNumber, $bankName, $bankCode)
    {
        $this->accountNumber = $accountNumber;
        $this->bankName = $bankName;
        $this->bankCode = $bankCode;
    }
}
