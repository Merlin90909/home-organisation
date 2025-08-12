<?php
$path = __DIR__ . '/../../../data/user.json';
$data = [];

$mail = $_POST['email'];
$path = __DIR__ . '/../../../data/user.json';
$data = json_decode(file_get_contents($path), true);
if(array_key_exists($mail, $data)) {
    header('Location: /register?alreadyRegistered');
}elseif(empty($_POST['fName']) || empty($_POST['lName']) || empty($_POST['email']) || empty($_POST['pwd']) || empty($_POST['pwd2'])) {
    header('Location: /register?invalidInput');
    exit;
}else if($_POST['pwd'] != $_POST['pwd2']){
    header('Location: /register?invalidPsswrd');
    exit;
} else if(strlen($_POST['pwd']) < 8){
    header('Location: /register?passwordTooShort');
    exit;
}else{
    $username = $_POST['email'];
    $newUser = [
        'first_Name' => $_POST['fName'],
        'last_Name' => $_POST['lName'],
        'email' => $username,
        'password' => $_POST['pwd']
    ];

    $data = json_decode(file_get_contents($path), true);
    $data[$username] = $newUser;
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($path, $jsonData);

    header('Location: /login');
}