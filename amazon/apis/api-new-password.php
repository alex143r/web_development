<?php
include_once(__DIR__ . '/../globals.php');

//validate key
if (!isset($_POST['key'])) {
    _res(400, ['info' => 'No key']);
    die();
}

if (strlen($_POST['key']) != 32) {
    _res(400, ['info' => 'Suspicious key']);
    die();
}

// Validate the password
if (!isset($_POST['newPass'])) {
    _res(400, ['info' => 'Password required']);
    die();
}
if (strlen($_POST['newPass']) < _PASSWORD_MIN_LEN) {
    _res(400, ['info' => 'Password must be atleast ' . _PASSWORD_MIN_LEN . ' characters']);
    die();
}
if (strlen($_POST['newPass']) > _PASSWORD_MAX_LEN) {
    _res(400, ['info' => 'Password must not be more than ' . _PASSWORD_MAX_LEN . ' characters']);
    die();
}
if ($_POST['newPass'] !== $_POST['newPassConfirm']) {
    _res(400, ['info' => 'Confirm password does not match']);
    die();
}
$db = require_once(__DIR__ . '/../db.php');


try {
    //check if forgot password key exists in db
    $query = $db->prepare('SELECT password_reset_key from users where password_reset_key = :password_reset_key');
    $query->bindValue(':password_reset_key', $_POST['key']);
    $query->execute();
    $row = $query->fetch();
    if (!$row) {
        _res(400, ['info' => 'Key does not exist']);
        die();
    }
} catch (Exception $ex) {
    _res(500, ['info' => 'system under maintainance']);
    die();
}


try {
    $hashed_password = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
    $new_password_reset_key = bin2hex(random_bytes(16));

    $q = $db->prepare('UPDATE users set user_password = :user_password, password_reset_key = :new_password_reset_key where password_reset_key = :password_reset_key');
    $q->bindValue(':user_password', $hashed_password);
    $q->bindValue(':password_reset_key', $_POST['key']);
    $q->bindValue(':new_password_reset_key', $new_password_reset_key);
    $q->execute();
    $row = $q->rowCount();

    if (!$row) {
        _res(500, ['info' => 'Failed to update password']);
    }

    //success
    _res(200, ['info' => 'Password changed successfully']);
} catch (Exception $ex) {
    _res(500, ['info' => 'System under maintainance']);
}
