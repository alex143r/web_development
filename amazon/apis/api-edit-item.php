<?php
require_once(__DIR__ . '/../globals.php');
session_start();

// TODO: Make sure the user is logged in

//Validate user is logged in
if (!isset($_POST['itemId'])) {
    _res(400, ['info' => 'No item selected']);
    die();
}
//validate item name
if (!isset($_POST['itemName'])) {
    _res(400, ['info' => 'Item name is required']);
    die();
}
if (strlen($_POST['itemName']) < _ITEM_MIN_LEN) {
    _res(400, ['info' => 'Item name must be minimum ' . _ITEM_MIN_LEN . ' characters']);
    die();
}
if (strlen($_POST['itemName']) > _ITEM_MAX_LEN) {
    _res(400, ['info' => 'Item name must not be longer than ' . _ITEM_MAX_LEN . ' characters']);
    die();
}
//validate item desc
if (!isset($_POST['itemDesc'])) {
    _res(400, ['info' => 'Item description is required']);
    die();
}
if (strlen($_POST['itemDesc']) < _ITEM_DESC_MIN_LEN) {
    _res(400, ['info' => 'Item description must be atleast ' . _ITEM_DESC_MIN_LEN . ' character']);
    die();
}
if (strlen($_POST['itemDesc']) > _ITEM_DESC_MAX_LEN) {
    _res(400, ['info' => 'Item description must not be longer than ' . _ITEM_DESC_MAX_LEN . ' characters']);
    die();
}

//validate item price
if (!isset($_POST['itemPrice'])) {
    _res(400, ['info' => 'Item price is required']);
    die();
}
if (!is_numeric($_POST['itemPrice'])) {
    _res(400, ['info' => 'Item price must be a number']);
    die();
}

if ($_POST['itemPrice'] > _ITEM_MAX_PRICE) {
    _res(400, ['info' => 'Item price must not be over ' . number_format(_ITEM_MAX_PRICE, 2, ',', '.') . ' dkk']);
    die();
}
if ($_POST['itemPrice'] < _ITEM_MIN_PRICE) {
    _res(400, ['info' => 'Item price must atleast ' . number_format(_ITEM_MIN_PRICE, 2, ',', '.') . ' dkk']);
    die();
}

//validate item image


if (file_exists($_FILES['itemImg']['tmp_name'])) {
    if (!in_array(pathinfo($_FILES['itemImg']['name'], PATHINFO_EXTENSION), _IMAGE_ALLOWED_FILE)) {
        _res(400, ['info' => 'Item image is not a valid filetype']);
        die();
    }
}

$db = require_once(__DIR__ . '/../db.php');

try {
    if (file_exists($_FILES['itemImg']['tmp_name'])) {

        $image_id = uniqid();
    } else {
        $image_id = $_POST['itemImg'];
    }
    $db->beginTransaction();
    $q = $db->prepare('UPDATE items SET item_name = :item_name, item_description = :item_description, item_price = :item_price, item_image = :item_image WHERE item_id = :item_id');
    $q->bindValue(':item_id', $_POST['itemId']);
    $q->bindValue(':item_name', $_POST['itemName']);
    $q->bindValue(':item_description', $_POST['itemDesc']);
    $q->bindValue(':item_price', $_POST['itemPrice']);
    $q->bindValue(':item_image', $image_id);
    $q->execute();
    $row = $q->rowCount();

    if (!$row) {
        _res(500, ['info' => $_POST['itemId']]);
        $db->rollBack();
        die();
    }

    if (file_exists($_FILES['itemImg']['tmp_name'])) {

        move_uploaded_file($_FILES['itemImg']['tmp_name'], __DIR__ . '/../item_images/' . $image_id);
    }

    $db->commit();
    _res(200, ['info' => 'Updated item: "' . $_POST['itemName'] . '"']);
} catch (Exception $ex) {
    _res(500, ['info' => $ex]);
    $db->rollBack();


    die();
}
