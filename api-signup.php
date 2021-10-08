<?php
//APIs almost never reply with html
//APIs almost always reply with JSON and HTTP status codes
//20x means ok. we will use 200
//30x means redirect - apis hardly use
//40x means client error - we will use 400
//50x means server error - we will use 500
//POST data
//http_response_code(500);


//validate Data
if (!isset($_POST['name'])) {
    send400('name is requried');
}

//count is used to get the number of elements in an array
if (strlen($_POST['name']) < 2) {
    send400('name must be atleast 2 characters');
}
if (strlen($_POST['name']) > 5) {
    send400('name must not be more than 5 characters');
}

//validate last name
if (!isset($_POST['lastName'])) {
    send400('last name is requried');
}
if (strlen($_POST['lastName']) < 2) {
    send400('last name must be atleast 2 characters');
}
if (strlen($_POST['lastName']) > 5) {
    send400('last name must not be more than 5 characters');
}

//Validate email
if (!isset($_POST['email'])) {
    send400('email hella requried');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    send400('use valid email beeech');
}

//connect to DB
//include / require
$db = require_once('db.php');

try {
    //insert data in the DB
    $q = $db->prepare('INSERT INTO users VALUES(:user_id, :user_name, :user_last_name, :user_email)');
    $q->bindValue(":user_id", null); // The DB will give this automatically
    $q->bindValue(":user_name", $_POST['name']);
    $q->bindValue(":user_last_name", $_POST['lastName']);
    $q->bindValue(":user_email", $_POST['email']);
    $q->execute();
    $user_id = $db->lastinsertid();

    //SUCCESS
    header('Content-Type: application/json');
    //echo '{"info":"user created", "user_id":"' . $user_id . '"}';
    $response = ["info" => "user created", "user_id" => $user_id];
    echo json_encode($response);
} catch (Exception $ex) {
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
