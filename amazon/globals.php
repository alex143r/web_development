<?php

define('_PASSWORD_MIN_LEN', 6);
define('_PASSWORD_MAX_LEN', 20);
define('_NAME_MIN_LEN', 2);
define('_NAME_MAX_LEN', 20);

function _res($status, $msg)
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($msg);
}
