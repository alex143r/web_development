<?php
//the user logs via a form passing email and password
$password = $_POST['password'];
// pretend we connect to the database and get the password of a user based on the email
// SELECT user_password FROM users WHERE user_email = :email
$hashed_password = '$2y$10$EE8EouFWiaSvM3FjfZ0Br.GdIsU5C8Pv3h/Onh9nNnlpIe.QOBIOO';

if (password_verify($password, $hashed_password)) {
    echo "nice";
} else {
    echo "wrong";
}
