<?php
//APIs almost never reply with html
//APIs almost always reply with JSON and HTTP status codes
//20x means ok. we will use 200
//30x means redirect - apis hardly use
//40x means client error - we will use 400
//50x means server error - we will use 500
//POST data
//http_response_code(500);

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

//Validate user password
if (!isset($_POST['password'])) {
    _res(400, ['info' => 'Password required']);
    die();
}
if (strlen($_POST['password']) < _PASSWORD_MIN_LEN) {
    _res(400, ['info' => 'Password must be atleast ' . _PASSWORD_MIN_LEN . ' characters']);
    die();
}
if (strlen($_POST['password']) > _PASSWORD_MAX_LEN) {
    _res(400, ['info' => 'Password must not be more than ' . _PASSWORD_MAX_LEN . ' characters']);
    die();
}
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//connect to DB
//include / require
$db = require_once(__DIR__ . '/../db.php');

// check if email or phone exists in db
try {
    $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email OR user_phone_number = :user_phone_number');
    $q->bindValue('user_email', $_POST['email']);
    $q->bindValue('user_phone_number', $_POST['phoneNo']);
    $q->execute();
    $row = $q->fetch();
    if ($row['user_email'] === $_POST['email']) {
        _res(400, ['info' => 'Email already exists']);
        die();
    }

    if ($row['user_phone_number'] === $_POST['phoneNo']) {
        _res(400, ['info' => 'Phone number already exists']);
        die();
    }
} catch (Exception $ex) {
    _res(500, ['info' => 'system under maintenance']);
}


try {
    //insert data in the DB
    $verification_key = bin2hex(random_bytes(16));
    $password_reset_key = bin2hex(random_bytes(16));


    $q = $db->prepare('INSERT INTO users VALUES(:user_id, :user_first_name, :user_last_name, :user_email, :user_phone_number, :user_password, :verified, :verification_key, :password_reset_key)');
    $q->bindValue(":user_id", null); // The DB will give this automatically
    $q->bindValue(":user_first_name", $_POST['firstName']);
    $q->bindValue(":user_last_name", $_POST['lastName']);
    $q->bindValue(":user_email", $_POST['email']);
    $q->bindValue(":user_phone_number", $_POST['phoneNo']);
    $q->bindValue(":user_password", $password);
    $q->bindValue(":verified", '0');
    $q->bindValue(":verification_key", $verification_key);
    $q->bindValue(":password_reset_key", $password_reset_key);
    $q->execute();
    $user_id = $db->lastinsertid();
    // SEND EMAIL
    $_to_email = $_POST['email'];
    $_subject = "acompany sign up";
    $_message = "Thank you for signing up for acompany. 
            <a href='http://localhost:8888/amazon/validate-user.php?key=$verification_key'>
                Click here to verify your account
            </a>
            <br><br>
            Thanks,
            <br>
            acompany";

    require_once(__DIR__ . "/../private/send-email.php");
    _res(200, ['info' => 'Signed up successfully', "user_id" => $user_id]);
} catch (Exception $ex) {
    _res(500, ['info' => 'System under maintenance']);
    die();
}
