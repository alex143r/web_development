<?php
session_start();

require_once(__DIR__ . '/../globals.php');

//validate first name
if (!isset($_POST['firstName'])) {
    _res(400, ['info' => 'First name is required']);
    die();
}

//count is used to get the number of elements in an array
if (strlen($_POST['firstName']) < _NAME_MIN_LEN) {
    _res(400, ['info' => 'First name must be atleast ' . _NAME_MIN_LEN . ' characters']);
    die();
}
if (strlen($_POST['firstName']) > _NAME_MAX_LEN) {
    _res(400, ['info' => 'First name must not be more than ' . _NAME_MAX_LEN . ' characters']);
    die();
}

//validate last name
if (!isset($_POST['lastName'])) {
    _res(400, ['info' => 'Last name is required']);
    die();
}
if (strlen($_POST['lastName']) < _NAME_MIN_LEN) {
    _res(400, ['info' => 'Last name must be atleast ' . _NAME_MIN_LEN . ' characters']);
    die();
}
if (strlen($_POST['lastName']) >  _NAME_MAX_LEN) {
    _res(400, ['info' => 'Last name must not be more than ' . _NAME_MAX_LEN . ' characters']);
    die();
}

//Validate email
if (!isset($_POST['email'])) {
    _res(400, ['info' => 'Email is required']);
    die();
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    _res(400, ['info' => 'Email is invalid']);
    die();
}

//validate phone no
if (!isset($_POST['phoneNo'])) {
    _res(400, ['info' => 'Phone number is required']);
    die();
}
if (strlen($_POST['phoneNo']) < _PHONE_LEN || strlen($_POST['phoneNo']) > _PHONE_LEN) {
    _res(400, ['info' => 'Phone number must be ' . _PHONE_LEN . ' characters']);
    die();
}
if (!ctype_digit($_POST['phoneNo'])) {
    _res(400, ['info' => 'Phone number must contain only numbers']);
    die();
}

$db = require_once(__DIR__ . '/../db.php');


try {

    $db->beginTransaction();
    $q = $db->prepare('UPDATE users SET user_first_name = :user_first_name, user_last_name = :user_last_name, user_email = :user_email, user_phone_number = :user_phone_number WHERE user_id = :user_id');
    $q->bindValue(':user_id', $_SESSION['user_id']);
    $q->bindValue(':user_first_name', $_POST['firstName']);
    $q->bindValue(':user_last_name', $_POST['lastName']);
    $q->bindValue(':user_email', $_POST['email']);
    $q->bindValue(':user_phone_number', $_POST['phoneNo']);
    $q->execute();
    $row = $q->rowCount();

    if (!$row) {
        _res(500, ['info' => 'Profile not updated']);
        $db->rollBack();
    }

    $db->commit();
    $_SESSION['user_first_name'] = $_POST['firstName'];
    $_SESSION['user_last_name'] = $_POST['lastName'];
    $_SESSION['user_email'] =  $_POST['email'];
    $_SESSION['user_phone_number'] =  $_POST['phoneNo'];
    _res(200, ['info' => 'Successfully updated your profile information']);
} catch (Exception $ex) {
    print_r($ex);
    _res(500, ['info' => 'system under maintenance', 'error' => __LINE__]);
    $db->rollBack();
    die();
}
