<?php
require_once(__DIR__ . '/../globals.php');
session_start();


//validate password
if (!isset($_POST['oldPass']) || !isset($_POST['newPass']) || !isset($_POST['newPassConfirm'])) {
    _res(400, ['info' => 'Password required']);
    die();
}
if (strlen($_POST['oldPass']) < _PASSWORD_MIN_LEN || strlen($_POST['newPass']) < _PASSWORD_MIN_LEN || strlen($_POST['newPassConfirm']) < _PASSWORD_MIN_LEN) {
    _res(400, ['info' => 'Password must be atleast ' . _PASSWORD_MIN_LEN . ' characters']);
    die();
}
if (strlen($_POST['oldPass']) > _PASSWORD_MAX_LEN || strlen($_POST['newPass']) > _PASSWORD_MAX_LEN || strlen($_POST['newPassConfirm']) > _PASSWORD_MAX_LEN) {
    _res(400, ['info' => 'Password must not be more than ' . _PASSWORD_MAX_LEN . ' characters']);
    die();
}

// Check if 2 new passwords match
if ($_POST['newPass'] !== $_POST['newPassConfirm']) {
    _res(400, ['info' => 'New passwords do not match']);
    die();
}

$db = require_once(__DIR__ . '/../db.php');
try {
    $oldPassword = $_POST['oldPass'];
    $newPassword = $_POST['newPass'];

    $q = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $q->bindValue(":user_id", $_SESSION['user_id']);
    $q->execute();
    $row = $q->fetch();
    if (!$row) {
        _res(400, ['info' => $_SESSION['user_id']]);
        die();
    }
    if (!password_verify($oldPassword, $row['user_password'])) {
        _res(400, ['info' => "Old password is incorrect"]);
        die();
    }

    $newHashedPassword = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
    $newVerificationKey = bin2hex(random_bytes(16));
    $q = $db->prepare('UPDATE users set user_password = :user_password, verified = :verified, verification_key = :verification_key WHERE user_id = :user_id');
    $q->bindValue(':user_id', $_SESSION['user_id']);
    $q->bindValue(':user_password', $newHashedPassword);
    $q->bindValue(':verified', 0);
    $q->bindValue(':verification_key', $newVerificationKey);
    $q->execute();
    $row = $q->rowCount();

    _res(200, ['info' => 'Password updated.']);
} catch (Exception $ex) {
    _res(500, ['info' => 'System under maintenance']);
    die();
}
