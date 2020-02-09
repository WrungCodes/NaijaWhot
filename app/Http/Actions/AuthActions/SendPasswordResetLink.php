<?php

namespace App\Http\Actions\AuthActions;

use App\Helpers\Find;
use App\Helpers\Generate;
use App\Helpers\SendEmail;
use App\Http\Requests\Auth\ResendVerificationMail;
use App\Http\Requests\Auth\SendPasswordResetMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SendPasswordResetLink
{
    private $request;

    public function __construct(SendPasswordResetMail $request)
    {
        $this->request = $request;
    }

    public function execute(): User
    {
        return $this->sendPasswordResetLink();
    }

    public function sendPasswordResetLink(): User
    {
        $email = $this->request->email;

        $user = Find::findUser('email', (string) $email);

        if (!$user) {
            throw new NotFoundHttpException("Invalid User");
        }

        $user->update(['password_token' => Generate::generateToken()]);

        $emailData = Generate::GenerateResetPasswordLink($user);

        SendEmail::verificationMail($user, $emailData);

        return $user;
    }
}
