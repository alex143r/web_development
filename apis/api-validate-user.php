<?php
require_once(__DIR__ . '/../globals.php');

// Verify the key, must be 32 char
if (!isset($_POST['key'])) {
    _res(400, ['info' => 'No key']);
    die();
}

if (strlen($_POST['key']) != 32) {
    _res(400, ['info' => 'Suspicious key']);
    die();
}

try {
    $db = require_once(__DIR__ . '/../db.php');
} catch (Exception $ex) {
    _res(500, ['info' => 'System under maintenance']);
}

try {
    // Insert data in the DB
    $q = $db->prepare('UPDATE users SET verified = 1 WHERE verified = 0 AND verification_key = :verification_key');
    $q->bindValue(":verification_key", $_POST['key']); // The db will give this automatically.
    $q->execute();
    $row = $q->rowCount();
    if (!$row) {
        _res(400, ['info' => 'Incorrect key']);
        die();
    }
    // SUCCESS
    session_start();
    $_SESSION['is_verified'] = true;
    _res(200, ['info' => 'Email verified successfully']);
} catch (Exception $ex) {
    _res(500, ['info' => 'system under maintenance', 'error' => __LINE__]);
    die();
}
