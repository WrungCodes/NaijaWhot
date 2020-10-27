<?php

namespace App\Http\Controllers;

use App\Helpers\Find;
use App\Http\Actions\AuthActions\CreateUser;
use App\Http\Actions\AuthActions\LoginUser;
use App\Http\Actions\AuthActions\ResendEmailVerificationUserMail;
use App\Http\Actions\AuthActions\ResetUserPassword;
use App\Http\Actions\AuthActions\SendPasswordResetLink;
use App\Http\Actions\AuthActions\ValidateUserMail;
use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\Register;
use App\Http\Requests\Auth\ResendVerificationMail;
use App\Http\Requests\Auth\ResetPassword;
use App\Http\Requests\Auth\SendPasswordResetMail;
use App\Http\Resources\Profile;
use App\Http\Resources\User as UserResource;
use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{
    public function login(Login $request)
    {
        return ['message' => 'Logged in successfully', 'token' => JWTAuth::fromUser((new LoginUser($request))->execute())];
    }

    public function register(Register $request)
    {
        return ['message' => 'Registration Successful', 'token' => JWTAuth::fromUser((new CreateUser($request))->execute())];
    }

    public function forgotPassword(SendPasswordResetMail $request)
    {
        return  ['message' => 'Reset Password Mail sent', 'token' => new UserResource((new SendPasswordResetLink($request))->execute())];
    }

    public function resetPassword(ResetPassword $request)
    {
        return ['message' => 'Password reset successfully', 'token' => JWTAuth::fromUser((new ResetUserPassword($request))->execute())];
    }

    public function validateEmail(Request $request)
    {
        return ['message' => 'Email verified successfully', 'user' => new UserResource((new ValidateUserMail($request))->execute())];
    }

    public function resendValidateEmail(ResendVerificationMail $request)
    {
        $request->validated();

        return  ['message' => 'Verify Email sent', 'token' =>  new UserResource((new ResendEmailVerificationUserMail($request))->execute())];
    }

    public function getUser(Request $request)
    {
        return new UserResource(Find::findAuthUser($request));
    }

    public function getUserProfile(Request $request)
    {
        return ['profile' => new Profile((Find::findAuthUser($request))->profile)];
    }

    public function refreshToken(Request $request)
    {
        return ['token' => $request->refresh_token];
    }

    public function createAdmin(Register $request)
    {
        return new UserResource(User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type_id' => UserType::ADMIN_USER
        ]));
    }

    public function getAllAdmin(Register $request)
    {
        return UserResource::collection(User::all()->where(['user_type_id' => UserType::ADMIN_USER]));
    }

    public function getAllPlayers(Register $request)
    {
        return UserResource::collection(User::all()->where(['user_type_id' => UserType::PLAYER_USER]));
    }
}
