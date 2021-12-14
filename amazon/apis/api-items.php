<?php
require_once(__DIR__ . '/../globals.php');
session_start();

//Validate user is logged in
if (!isset($_SESSION['user_id'])) {
    _res(400, ['info' => 'User needs to be logged in']);
    die();
}

$db = require_once(__DIR__ . '/../db.php');

try {
    $q = $db->prepare('SELECT * FROM items INNER JOIN users ON items.user_id = users.user_id WHERE items.user_id = :user_id AND users.user_id = :user_id');
    $q->bindValue(':user_id', $_SESSION['user_id']);
    $q->execute();
    $row = $q->fetch();

    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($row);
} catch (Exception $ex) {
    _res(500, ['info' => $ex]);

    die();
}