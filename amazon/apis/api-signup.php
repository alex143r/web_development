<?php
//APIs almost never reply with html
//APIs almost always reply with JSON and HTTP status codes
//20x means ok. we will use 200
//30x means redirect - apis hardly use
//40x means client error - we will use 400
//50x means server error - we will use 500
//POST data
//http_response_code(500);




//validate first name
if (!isset($_POST['firstName'])) {
    send400('First name is required');
}

//count is used to get the number of elements in an array
if (strlen($_POST['firstName']) < 2) {
    send400('First name must be atleast 2 characters');
}
if (strlen($_POST['firstName']) > 50) {
    send400('First name must not be more than 50 characters');
}

//validate last name
if (!isset($_POST['lastName'])) {
    send400('Last name is required');
}
if (strlen($_POST['lastName']) < 2) {
    send400('Last name must be atleast 2 characters');
}
if (strlen($_POST['lastName']) > 50) {
    send400('Last name must not be more than 50 characters');
}

//Validate email
if (!isset($_POST['email'])) {
    send400('Email is required');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    send400('Invalid email');
}

//Validate user password
if (!isset($_POST['password'])) {
    send400('Password required');
}
if (strlen($_POST['password']) < 5) {
    send400('Password must be atleast 5 characters');
}
if (strlen($_POST['password']) > 20) {
    send400('Password must not be more than 20 characters');
}
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//connect to DB
//include / require
$db = require_once(__DIR__ . '/../db.php');



try {
    //insert data in the DB
    $verification_key = bin2hex(random_bytes(16));

    $q = $db->prepare('INSERT INTO users VALUES(:user_id, :user_first_name, :user_last_name, :user_email, :user_password, :verified, :verification_key)');
    $q->bindValue(":user_id", null); // The DB will give this automatically
    $q->bindValue(":user_first_name", $_POST['firstName']);
    $q->bindValue(":user_last_name", $_POST['lastName']);
    $q->bindValue(":user_email", $_POST['email']);
    $q->bindValue(":user_password", $password);
    $q->bindValue(":verified", '0');
    $q->bindValue(":verification_key", $verification_key);
    $q->execute();
    $user_id = $db->lastinsertid();
    // SEND EMAIL
    $_to_email = $_POST['email'];
    $_message = "Thank you for signing up for acompany. 
            <a href='http://localhost:8888/amazon/validate-user.php?key=$verification_key'>
                Click here to verify your account
            </a>
            <br><br>
            Thanks,
            <br>
            acompany";

    require_once(__DIR__ . "/../private/send-email.php");
    //SUCCESS
    header('Content-Type: application/json');
    //echo '{"info":"user created", "user_id":"' . $user_id . '"}';
    $response = ["info" => "user created", "user_id" => $user_id];
    echo json_encode($response);
} catch (Exception $ex) {
    print_r($ex);
    http_response_code(500);
    echo 'System under maintenance';
    die();
}

//function to manage responding in case of error
function send400($errorMessage)
{
    header('Content-Type: application/json');
    http_response_code(400);
    $response = ["info" => $errorMessage];
    echo json_encode($response);
    die();
}
