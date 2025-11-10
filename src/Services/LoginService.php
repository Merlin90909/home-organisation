<?php

namespace App\Services;

use Framework\Services\UserService;

class LoginService
{
    public function __construct(private UserService $userService)
    {
    }

    function login(string $email, string $password): bool
    {
        if (empty($email) || empty($password)) {
            return false;
        }

        $user = $this->userService->getUserByEmail($email);
        //dd($user);

        if (!$user) {
            return false;
        }

        $userPassword = $user->password;
        //dd($userPassword);

        if ($userPassword != $password) {
            //dd('false');
            return false;
        }
            //dd('true');
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->firstName . ' ' . $user->lastName;

        return true;
    }
}