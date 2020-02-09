<?php

namespace App\Helpers;

use App\Mail\InfoMail;
use App\Mail\TransactionMail;
use App\Mail\VerifyMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    public static function verificationMail(User $user, array $data)
    {
        Mail::to($user->email)->send(new VerifyMail($data));
    }
}
