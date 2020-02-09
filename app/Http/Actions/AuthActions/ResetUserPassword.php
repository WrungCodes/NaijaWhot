<?php

namespace App\Http\Actions\AuthActions;

use App\Helpers\Find;
use App\Helpers\Generate;
use App\Helpers\SendEmail;
use App\Http\Requests\Auth\ResendVerificationMail;
use App\Http\Requests\Auth\ResetPassword;
use App\Http\Requests\Auth\SendPasswordResetMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResetUserPassword
{
    private $request;

    public function __construct(ResetPassword $request)
    {
        $this->request = $request;
    }

    public function execute(): User
    {
        return $this->ResetPassword();
    }

    public function ResetPassword(): User
    {
        $token =  $this->request->token;

        $user = Find::findUser('password_token', (string) $token);

        if (!$user) {
            throw new NotFoundHttpException("Invalid User");
        }

        $user->update([
            'password_token' => null,
            'password' => Hash::make($this->request->password)
        ]);

        return $user;
    }
}
