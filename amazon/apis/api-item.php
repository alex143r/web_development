<?php

require_once(__DIR__ . '/../globals.php');

// Validate user is logged in
if (!isset($_POST['item_id'])) {
    _res(400, ['info' => $_POST['item_id']]);
    die();
}
if (strlen($_POST['item_id']) < 1) {
    _res(400, ['info' => 'Go back and choose an item to edit!']);
    die();
}



$db = require_once(__DIR__ . '/../db.php');

try {
    $q = $db->prepare('SELECT * FROM items WHERE item_id = :item_id');
    $q->bindValue(':item_id', $_POST['item_id']);
    $q->execute();
    $row = $q->fetch();

    // // http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($row);
    //_res(200, ['items' => $row]);
} catch (Exception $ex) {
    _res(500, ['info' => $ex]);

    die();
}
