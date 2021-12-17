<?php

define('_PASSWORD_MIN_LEN', 6);
define('_PASSWORD_MAX_LEN', 20);
define('_NAME_MIN_LEN', 2);
define('_NAME_MAX_LEN', 20);
define('_PHONE_LEN', 8);
define('_ITEM_MIN_LEN', 2);
define('_ITEM_MAX_LEN', 60);
define('_ITEM_DESC_MAX_LEN', 255);
define('_ITEM_DESC_MIN_LEN', 1);
define('_ITEM_MAX_PRICE', 10000000);
define('_ITEM_MIN_PRICE', .1);
define('_IMAGE_ALLOWED_FILE', array('jpeg', 'jpg', "png", "gif", "bmp", "JPEG", "JPG", "PNG", "GIF", "BMP"));





function _res($status = 200, $msg = [])
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($msg);
}
