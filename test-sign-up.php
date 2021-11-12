<?php
$name = "A";
$_to_email = "aotkea21@gmail.com";
$verification_key = bin2hex(random_bytes(16));
//$verification_key = "12121212121212121212121212121212";
$_message = "Thank you for signing up for Acompany. 
            <a href='http://localhost:8888/amazon/validate-user.php?key=$verification_key'>
                Click here to verify your account
            </a>
            <br><br>
            Thanks,
            <br>
            Acompany";

require_once(__DIR__ . "/amazon/private/send-email.php");
