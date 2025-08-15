<?php

class LoginService
{
    function login(string $email, string $password): bool
    {
        $UserService = new UserService();
        $user = $UserService->getUserByEmail($email);

        if (!$user) {
            return false;
        }
        if ($password !== $user["password"]) {
            return false;
        }
        $_SESSION['logged_in'] = true;

        return true;
    }
}