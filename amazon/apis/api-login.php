<?php
//the user logs via a form passing email and password
require_once(__DIR__ . '/../globals.php');

if (!isset($_POST['user_email'])) {
    send400('email hella requried');
}
if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    send400('use valid email beeech');
}

$db = require_once(__DIR__ . '/../db.php');

// pretend we connect to the database and get the password of a user based on the email
// SELECT user_password FROM users WHERE user_email = :email
//$hashed_password = '$2y$10$EE8EouFWiaSvM3FjfZ0Br.GdIsU5C8Pv3h/Onh9nNnlpIe.QOBIOO';

// if (password_verify($password, $hashed_password)) {
//     echo "nice";
// } else {
//     echo "wrong";
// }

try {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email');
    $q->bindValue(":user_email", $email); // The DB will give this automatically
    //    $q->bindValue(":user_password", $hashed_password);
    $q->execute();
    $row = $q->fetch();
    if (!$row) {
        //_res(400, ['info' => 'wrong credentials', 'error' => __LINE__]);
        echo "wat";
    }
    if (!password_verify($password, $row['user_password'])) {
        die();
    }
    // Success
    session_start();
    $_SESSION['user_name'] = $row['user_first_name'];
    _res(200, ['info' => 'success login']);
    //SUCCESS
    // header('Content-Type: application/json');
    // //echo '{"info":"user created", "user_id":"' . $user_id . '"}';
    // $response = ["info" => "user created", "user_id" => $user_id];
    // echo json_encode($response);
    header("location:../index.php");
} catch (Exception $ex) {
    http_response_code(500);
    echo 'System under maintenance';
    die();
}

function send400($errorMessage)
{
    header('Content-Type: application/json');
    http_response_code(400);
    _res(500, ['info' => 'system under maintainance', 'error' => __LINE__]);

    die();
}
