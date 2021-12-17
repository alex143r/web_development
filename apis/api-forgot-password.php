<?php
require_once(__DIR__ . '/../globals.php');

//validate email
if (!isset($_POST['user_email'])) {
    _res(400, ['info' => 'Email is required']);
    die();
}
if (!filter_var($_POST['user_email'],  FILTER_VALIDATE_EMAIL)) {
    _res(400, ['info' => 'Email is not valid']);
    die();
}

$db = require_once(__DIR__ . '/../db.php');


try {
    //check if email exists
    $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email');
    $q->bindValue('user_email', $_POST['user_email']);
    $q->execute();
    $row = $q->fetch();

    if (!$row) {
        _res(400, ['info' => 'Email not found']);
        die();
    }

    $_to_email = $_POST['user_email'];
    $_subject = "acompany password reset";
    $password_reset_key = $row['password_reset_key'];
    $_message = "Hello. It seems like you have forgotten your password!
        <a href='http://localhost:8888/new-password.php?key=$password_reset_key'> Click here to create a new one!</a> <br><br>
            Thanks,
            <br>
            acompany";


    require_once(__DIR__ . "/../private/send-email.php");

    //success
    _res(200, ['info' => 'Email sent successfully']);
} catch (Exception $ex) {
    print_r($ex);
    _res(500, ['info' => 'system under maintenance']);
}
