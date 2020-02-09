<?php

namespace App\Http\Actions\AuthActions;

use App\Helpers\Find;
use App\Helpers\Generate;
use App\Helpers\SendEmail;
use App\Http\Requests\Auth\ResendVerificationMail;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResendEmailVerificationUserMail
{
    private $request;

    public function __construct(ResendVerificationMail $request)
    {
        $this->request = $request;
    }

    public function execute(): User
    {
        return $this->resendValidateUserMail();
    }

    public function resendValidateUserMail(): User
    {
        $email = $this->request->email;

        $user = Find::findUser('email', (string) $email);

        if (!$user) {
            throw new NotFoundHttpException("Invalid User");
        }

        if (!$user->email_token) {
            throw new NotFoundHttpException("User already verified");
        }

        $emailData = Generate::GenerateVerification($user);

        SendEmail::verificationMail($user, $emailData);

        return $user;
    }
}
