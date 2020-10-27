<?php

namespace App\Http\Actions\AuthActions;

use App\Helpers\Generate;
use App\Helpers\SendEmail;
use App\Http\Requests\Auth\Register;
use App\Profile;
use App\User;
use App\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser
{
    private $request;

    public function __construct(Register $request)
    {
        $this->request = $request;
    }

    public function execute(): User
    {
        return $this->createNewUser();
    }

    public function createNewUser(): User
    {
        try {
            $user = User::create([
                'username' => $this->request->username,
                'email' => $this->request->email,
                'password' => Hash::make($this->request->password),
                'user_type_id' => UserType::PLAYER_USER,
                'email_token' => null //Generate::generateToken()
            ]);

            $user->profile()->save($this->createUserProfile(0.00));

            // $emailData = Generate::GenerateVerification($user);

            // SendEmail::verificationMail($user, $emailData);

            return $user;
        } catch (\Throwable $th) {
            abort(HTTP_BAD_REQUEST, "Unable to create user", []);
        }
    }

    private function createUserProfile(float $naira_balance): Profile
    {
        $profile = new Profile;

        $profile->naira_balance = $naira_balance;

        return $profile;
    }
}
