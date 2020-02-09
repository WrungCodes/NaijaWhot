<?php

namespace App\Http\Actions\AuthActions;

use App\Helpers\Find;
use App\Helpers\Generate;
use App\Http\Requests\Auth\Login;
use App\User;
use App\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LoginUser
{
    private $request;

    public function __construct(Login $request)
    {
        $this->request = $request;
    }

    public function execute(): User
    {
        return $this->loginUser();
    }

    public function loginUser(): User
    {

        $user = null;
        $errorMessage = '';

        if ($this->request->username) {

            $user = Find::FindUser('username', $this->request->username);
            $errorMessage = "username";
        } elseif ($this->request->email) {

            $user = Find::FindUser('email', $this->request->email);
            $errorMessage = "email";
        }
        if ($user == null) {
            abort(HTTP_PRECONDITION_FAILED, "Invalid " . $errorMessage);
        }

        if (!Hash::check($this->request->password, $user->password)) {
            abort(HTTP_PRECONDITION_FAILED, "Incorrect Password");
        }

        if ($user->email_token && $user->user_type_id == UserType::PLAYER_USER) {
            abort(HTTP_NOT_ACCEPTABLE, "Your account has not been verified");
        }

        return $user;
    }
}
