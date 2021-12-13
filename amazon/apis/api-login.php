<?php
//the user logs via a form passing email and password
require_once(__DIR__ . '/../globals.php');

//validate email
if (!isset($_POST['user_email'])) {
    _res(400, ['info' => 'Email required']);
    die();
}
if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    _res(400, ['info' => 'Email not valid']);
    die();
}
//validate password 
if (!isset($_POST['user_password'])) {
    _res(400, ['info' => 'Password required']);
    die();
}

$db = require_once(__DIR__ . '/../db.php');


try {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email');
    $q->bindValue(":user_email", $email);
    $q->execute();
    $row = $q->fetch();
    if (!$row) {
        _res(400, ['info' => 'Email does not exist']);
        die();
    }
    if (!password_verify($password, $row['user_password'])) {
        _res(400, ['info' => "Password is incorrect"]);
        die();
    }
    // Success
    session_start();
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_first_name'] = $row['user_first_name'];
    $_SESSION['user_last_name'] = $row['user_last_name'];
    $_SESSION['user_email'] = $row['user_email'];
    $_SESSION['user_phone_number'] = $row['user_phone_number'];


    _res(200, ['info' => 'Login success']);
} catch (Exception $ex) {
    _res(500, ['info' => 'System under maintenance']);
    die();
}
