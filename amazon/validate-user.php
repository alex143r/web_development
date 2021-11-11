<?php

// TODO: Verify the key, must be 32 char
if (!isset($_GET['key'])) {
    echo "not a key sus";
    die();
}

if (strlen($_GET['key']) != 32) {
    echo "incorrect sussy key";
    die();
}
// if (!is_int($_GET['key'])) {
//     echo "sus again";
//     die();
// }

// TODO: connect to the db
$data = json_decode(file_get_contents("data.json"), true);
//echo $json_data->verification_key;
//echo $data['verification_key'];

//$db = require_once(__DIR__ . '/../db.php');

// TODO: update the verified to 1 if there is a match
if ($_GET['key'] != $data['verification_key']) {
    echo 'keys dont match';
    die();
}

$data['verified'] = 1; //update fcommand

file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));
/*
UPDATE users SET verifed = 1 WHERE verified = 0 AND verified_key = :verified_key
*/
// TODO: Say congrats to user
echo 'grats';
