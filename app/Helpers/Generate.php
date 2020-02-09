<?php

namespace App\Helpers;

use App\User;

class Generate
{
    public static function GenerateVerification(User $user)
    {
        $link = route('user.verify', [$user->email_token]);

        $email = [
            'link' => $link,
            'subject' => 'Verify Email',
            'sender' =>  config('company.company_mail'),
            'sender_name' =>  config('company.company_name'),
            'reciever_user_name' => $user->username
        ];

        return $email;
    }

    public static function GenerateResetPasswordLink(User $user)
    {
        $link = route('user.reset-password', [$user->password_token]);

        $email = [
            'link' => $link,
            'subject' => 'Reset Password',
            'sender' =>  config('company.company_mail'),
            'sender_name' =>  config('company.company_name'),
            'reciever_user_name' => $user->username,
        ];

        return $email;
    }

    /**
     * Generate a 64 bytes string for api token
     *
     * @return string
     */
    public static function generateToken(): string
    {
        return bin2hex(openssl_random_pseudo_bytes(64));
    }
}
