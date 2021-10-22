<?php
require_once(__DIR__ . '/../globals.php');


// TODO: Make sure the user is logged in

//Validate user

$db = _api_db();

try {
    $q = $db->prepare('DELETE FROM items where item_id = :item_id');
    $q->bindValue(':item_id', $_POST['item_id']);
    $q->execute();

    echo 'Item delete with id ' . $_POST['item_id'];
} catch (Exception $ex) {
    http_response_code(500);
    echo ($ex);
    echo 'System under maintenance ' . __LINE__;
    die();
}
