<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?? 'Acompany' ?></title>
    <link rel="stylesheet" href="app.css">
</head>

<body>
    <p><?php
        if (isset($_SESSION['user_name'])) {
            echo $_SESSION['user_name'];
        }  ?></p>