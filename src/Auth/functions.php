<?php

//reg_controller--------------------------------------------------------------------------------------------------------
function user_request($mail, $data): bool
{
    return array_key_exists($mail, $data);
}

function user_exists($mail, $data): bool
{
    if (user_request($mail, $data)) {
        header('Location: /register?error=user_already_exists');
        exit;
    }
    return false;
}

function empty_register($fName, $lName, $email, $pwd, $pwd2)
{
    if (empty($fName) || empty($lName) || empty($email) || empty($pwd) || empty($pwd2)) {
        header('location: /register?error=fields_not_filled_in');
        exit;
    } else {
        return true;
    }
}

function equal_pwd($pwd, $pwd2)
{
    if ($pwd !== $pwd2) {
        header('location: /register?error=pwd_mismatch');
        exit;
    } else {
        return true;
    }
}

function password_usage($pwd): bool
{
    if ((strlen($pwd) < 8)) {
        header('location: /register?error=pwd_too_short');
        exit;
    } else {
        return true;
    }
}

function create_user($path)
{
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
}


/* zz_old Code (funktioniert aber)
if (array_key_exists($mail, $data)) {
    header('Location: /register?alreadyRegistered');
} elseif (empty($_POST['fName']) || empty($_POST['lName']) || empty($_POST['email']) || empty($_POST['pwd']) || empty($_POST['pwd2'])) {
    header('Location: /register?invalidInput');
    exit;
} else {
    if ($_POST['pwd'] != $_POST['pwd2']) {
        header('Location: /register?invalid_psswrd');
        exit;
    } else {
        if (strlen($_POST['pwd']) < 8) {
            header('Location: /register?password_too_short');
            exit;
        } else {
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
    }
}
 */
//dashboard-------------------------------------------------------------------------------------------------------------

function session_delete()
{
    $destroySessionFlag = filter_input(INPUT_POST, 'destroySession');
    if ($destroySessionFlag == 1) {
        session_destroy();
        header('Location: /login');
    }
}

//log_controller--------------------------------------------------------------------------------------------------------

function empty_data($email, $passwort)
{
    if (empty($email) || empty($passwort)) {
        header('Location: /login?invalidInput');
        exit;
    } else {
        return true;
    }
}

function user_found($data, $email)
{
    if (is_array($data)) {
        $found = false;
        foreach ($data as $entry) {
            if (isset($entry['email']) && $entry['email'] === $email) {
                $found = true;
                break;
            }
        }
        if ($found) {
            $_SESSION['is_login'] = true;
            header('Location: /');
            exit;
        } else {
            if (!isset($_SESSION['is_login']) && $_SESSION['is_login']) {
                header('Location: /login?login=false');
                exit;
            } else {
                // header('Location: /');
                // exit;
                return true;
            }
        }
    }
}
//Header, Footer
function headder(){
return '<!doctype html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/style/style.css">
    <title>Home‑Organizer</title>
</head>
<body class="dashboard-body">
  <header class="topbar">
    <div class="container">
      <div class="brand">Home‑Organizer</div>
      <nav class="nav-links">
        <a href="/">Dashboard</a>
        <a href="/register">Registrieren</a>
        <a href="/login">LogIn</a>
        <a href="/impressum">Impressum</a>
      </nav>
      <form action="" method="post" class="logout topbar-actions">
        <input type="hidden" name="destroySession" value="1">
        <input type="submit" value="Logout" class="btn btn-outline">
      </form>
    </div>
  </header>';
}
function footer(){
    return '
<footer class="page-footer">
  <div class="container">
    <small>© 2025 by Alexander Albrecht</small>
  </div>
</footer>
</body>
</html>';
}