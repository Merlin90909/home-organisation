<?php

class RegisterService
{
    function register(string $first_Name, string $last_Name, string $email, string $pwd, string $pwd2): bool
    {
        $UserService = new UserService();
        $user = $UserService->getUserbyEmail($email);

        if ($user) {
            return false;
        }

        if (empty($first_Name) || empty($last_Name) || empty($email) || empty($pwd) || empty($pwd2)) {
            return false;
        }

        if ($pwd !== $pwd2) {
            return false;
        }

        if (strlen($pwd) < 8) {
            return false;
        }
        //var_dump($first_Name, $last_Name, $email, $pwd);
        //exit;
        $path = __DIR__ . '/../../data/users.json';

        $newUser = [
            'first_Name' => $first_Name,
            'last_Name' => $last_Name,
            'email' => $email,
            'password' => $pwd
        ];
        $data = json_decode(file_get_contents($path), true);
        $data[$email] = $newUser;
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, $jsonData);

        return true;

    }
}