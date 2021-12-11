<?php
require_once(__DIR__ . '/../globals.php');

// Verify the key, must be 32 char
if (!isset($_GET['key'])) {
    _res(400, ['info' => 'No key']);
    die();
}

if (strlen($_GET['key']) != 32) {
    echo "incorrect key";
    die();
}


// connect to the db
$data = json_decode(file_get_contents("data.json"), true);
//echo $json_data->verification_key;
//echo $data['verification_key'];

try {
    $db = require_once(__DIR__ . '/../db.php');
} catch (Exception $ex) {
    _res(500, ['info' => 'system under maintainance', 'error' => __LINE__]);
}

// TODO: update the verified to 1 if there is a match
if ($_GET['key'] != $data['verification_key']) {
    echo 'keys dont match';
    echo $_GET['key'];
    die();
}

try {
    // Insert data in the DB
    $q = $db->prepare('UPDATE users SET verified = 1 WHERE verified = 0 AND verification_key = :verification_key');
    $q->bindValue(":verification_key", $_GET['key']); // The db will give this automati.
    $q->execute();
    $user_id = $db->lastInsertId();
    // SUCCESS
    header('Content-Type: application/json');
    // echo '{"info":"user created", "user_id":"'.$user_id.'"}';
    //$response = ["info" => "user created", "user_id" => intval($user_id)];
    //echo json_encode($response);'
    echo "success";
} catch (Exception $ex) {
    http_response_code(500);
    echo 'System under maintainance';
    exit();
}


//$data['verified'] = 1; //update fcommand

//file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));
/*
UPDATE users SET verifed = 1 WHERE verified = 0 AND verified_key = :verified_key
*/
// TODO: Say congrats to user
echo 'grats';
