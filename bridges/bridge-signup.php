<?php
//Bridge never has html or respond with data
//always take you somewhere else
if (!isset($_POST['email'])) {
    header("Location: signup.php");
    die();
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header("Location: signup.php");
    die();
}

header("Location: signup-ok.php");
die();
