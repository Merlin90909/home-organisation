<?php

class LoginService
{
    function login(string $email, string $password): bool
    {
        $UserService = new UserService();
        $user = $UserService->getUserbyEmail($email);

        if (!$user) {
            return false;
        }
        if ($user->password !== $password) {
            return false;
        }

        if ($user->email != $email) {
            return false;
        }

        $_SESSION['logged_in'] = true;

        return true;
    }
}