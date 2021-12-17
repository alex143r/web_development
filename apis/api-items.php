<?php

require_once(__DIR__ . '/../globals.php');

$db = require_once(__DIR__ . '/../db.php');

try {

    $q = $db->prepare('SELECT * FROM items');
    $q->execute();
    $row = $q->fetchAll();

    header('Content-Type: application/json');
    echo json_encode($row);
    //_res(200, ['items' => $row]);
} catch (Exception $ex) {
    _res(500, ['info' => $ex]);
    die();
}
