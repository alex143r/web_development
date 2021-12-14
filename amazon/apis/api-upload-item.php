<?php
require_once(__DIR__ . '/../globals.php');
session_start();

// TODO: Make sure the user is logged in

//Validate user is logged in
if (!isset($_SESSION['user_id'])) {
    _res(400, ['info' => 'User needs to be logged in']);
    die();
} //validate item name
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
if (!ctype_digit($_POST['itemPrice'])) {
    _res(400, ['info' => 'Item price must be a number']);
    die();
}
if ($_POST['itemPrice'] > _ITEM_MAX_PRICE) {
    _res(400, ['info' => 'Item price must not be over' . number_format(_ITEM_MAX_PRICE, 2, ',', '.') . ' dkk']);
    die();
}
if ($_POST['itemPrice'] > _ITEM_MAX_PRICE) {
    _res(400, ['info' => 'Item price must not be over' . number_format(_ITEM_MAX_PRICE, 2, ',', '.') . ' dkk']);
    die();
}
if ($_POST['itemPrice'] < _ITEM_MIN_PRICE) {
    _res(400, ['info' => 'Item price must atleast' . _ITEM_MIN_PRICE . ' dkk']);
    die();
}

//validate item image
if (!file_exists($_FILES['itemImg']['tmp_name'])) {
    _res(400, ['info' => 'Item image is required']);
    die();
}

if (!in_array(pathinfo($_FILES['itemImg']['name'], PATHINFO_EXTENSION), _IMAGE_ALLOWED_FILE)) {
    _res(400, ['info' => 'Item image is not a valid filetype']);
    die();
}

//move_uploaded_file($_FILES['itemImg']['tmp_name'], __DIR__ . '/../item_images/' . uniqid());

$db = require_once(__DIR__ . '/../db.php');

// try {
//     $item_id = bin2hex(random_bytes(16));
//     $q = $db->prepare('INSERT INTO items VALUES(:item_id, :item_name, :item_description)');
//     $q->bindValue(':item_id', $item_id);
//     $q->bindValue(':item_name', $_POST['item_name']);
//     $q->execute();
//     echo 'Item created with id ' . $item_id;
_res(200, ['info' => 'Created item ' . $_POST['itemName']]);

// } catch (Exception $ex) {
//     http_response_code(500);
//     echo 'System under maintenance ' . __LINE__;
//     die();
// }
