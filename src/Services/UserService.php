<?php

class UserService
{
    function getUserbyEmail(string $email): ?array
    {
        $path = __DIR__ . '/../../data/user.json';
        $json = file_get_contents($path);
        $users = json_decode($json, true);

        return $users[$email] ?? null;
    }
}