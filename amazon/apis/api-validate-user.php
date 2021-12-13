<?php
require_once(__DIR__ . '/../globals.php');

// Verify the key, must be 32 char
if (!isset($_POST['key'])) {
    _res(400, ['info' => 'No key']);
    die();
}

if (strlen($_POST['key']) != 32) {
    _res(400, ['info' => 'No key']);
    die();
}

try {
    $db = require_once(__DIR__ . '/../db.php');
} catch (Exception $ex) {
    _res(500, ['info' => 'system under maintainance']);
}
// try {
//     $query = $db->prepare('SELECT * FROM users WHERE user_verification_key = :user_verification_key');
//     $query->bindValue(":user_verification_key", $_POST['key']);
//     $query->execute();
//     $row = $query->fetch();

//     if (!$row) {
//         _res(400, ['info' => 'Verification key not found or invalid', 'error' => __LINE__]);
//     }
// } catch (Exception $ex) {
//     _res(500, ['info' => 'system under maintainance', 'error' => __LINE__]);
// }

try {
    // Insert data in the DB
    $q = $db->prepare('UPDATE users SET verified = 1 WHERE verified = 0 AND verification_key = :verification_key');
    $q->bindValue(":verification_key", $_POST['key']); // The db will give this automatically.
    $q->execute();
    $user_id = $db->lastInsertId();
    // SUCCESS
    session_start();
    $_SESSION['is_verified'] = true;
    _res(200, ['info' => 'Email verified successfully']);
} catch (Exception $ex) {
    _res(500, ['info' => 'system under maintainance', 'error' => __LINE__]);
    die();
}
