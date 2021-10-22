<?php

try {
    $message = $_POST['message'];
    $to_phone = $_POST['to_phone'];
    $url = 'https://fatsms.com/send-sms';
    $data = array('message' => $message, 'to_phone' => $to_phone, 'api_key' => '23b4a5fa-1568-49bd-9fb7-6cc92d2c607d');

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
} catch (Exception $ex) {
    http_response_code(500);
    echo 'System under maintenance ' . __LINE__;
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form onsubmit="return false">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone">
        <label>Message</label>
        <input type="text" name="message" id="message">

        <button onclick="sendMessage()">Send</button>
    </form>
    <div class="response"></div>


</body>

<script>
    async function sendMessage() {
        const message = document.querySelector("#message").value;
        const phone = document.querySelector("#phone").value;
        console.log(message, phone)
        const formData = new FormData();
        formData.append("message", message);
        formData.append("to_phone", phone);

        const conn = await fetch('index.php', {
            method: "POST",
            body: formData
        })
        const res = await conn.text();
        document.querySelector(".response").innerHTML = "great success";

    }
</script>

</html>