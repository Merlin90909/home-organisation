<?php

class RegisterService
{
    function register(string $first_Name, string $last_Name, string $email, string $pwd, string $pwd2): bool
    {
        // $UserService = new UserService();
        // $user = $UserService->getUserbyEmail($email);

        // if ($user) {
        //     return false;
        // }

        if (empty($first_Name) || empty($last_Name) || empty($email) || empty($pwd) || empty($pwd2)) {
            return false;
        }

        if ($pwd !== $pwd2) {
            return false;
        }

        if (strlen($pwd) < 8) {
            return false;
        }

        //$path = __DIR__ . '/../../data/home-organisation.sqlite';

        // $newUser = [
        //     'first_Name' => $first_Name,
        //     'last_Name' => $last_Name,
        //     'email' => $email,
        //     'password' => $pwd
        // ];


        $pdo = new PDO('sqlite:' . __DIR__ . '/../../data/home-organisation.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare(
            'INSERT INTO user (first_Name, last_Name, email, pwd) VALUES (:firstName, :lastName, :email, :password)'
        );
        $statement->execute([
            'firstName' => $first_Name,
            'lastName' => $last_Name,
            'email' => $email,
            'password' => $pwd,
        ]);

        return true;

        //$data = json_decode(file_get_contents($path), true);
        //$data[$email] = $newUser;
        //$jsonData = json_encode($data, JSON_PRETTY_PRINT);
        //file_put_contents($path, $jsonData);


    }
}