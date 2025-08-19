<?php
$pdo = new PDO('sqlite:' . __DIR__ . '/home-organisation.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec("CREATE TABLE user(
   first_name TEXT(30) NOT NULL,
   last_name TEXT(30) NOT NULL,
   email TEXT(30) PRIMARY KEY NOT NULL,
   pwd TEXT(30) NOT NULL
)");

