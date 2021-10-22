<?php
// Signup
// This sould come from input field/form/ POST 
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// INSERT INTO users VALUES(......$password)
echo $password;
