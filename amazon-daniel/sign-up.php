<?php
$_title = 'Amazing | Sign Up';
$_className = "signup";
require_once 'components/header.php';
require_once 'db.php';


?>
<section class="main-content-form">
    <div class="logo-wrapper">
        <a href="index.php"><img class="logo-black" src="images/logo-black.svg" /></a>
    </div>

    <div class="form-wrapper">

        <form id="form-sign-up" onsubmit="return false">
            <label for="name">Name</label>
            <input name="name" type="text" placeholder="">
            <p class="error-msg"></p>
            <label for="last_name">Last Name</label>
            <input name="last_name" type="text" placeholder="">
            <label for="email">Email</label>
            <input name="email" type="text" placeholder="">
            <label for="password">Password</label>
            <input name="password" type="password" placeholder="">
            <button class="sign-up-btn" onclick="sign_up()">Create your Amazing account</button>
        </form>


    </div>
    </div>

</section>

<?php

require_once 'components/footer.php';

?>
<script>
    async function sign_up() {
        let conn = await fetch('apis/api-signup.php', {
            method: "POST",
            body: new FormData(document.querySelector("#form-sign-up"))
        })
        let response = await conn.json();
        console.log(response)
        handleError();

        function handleError() {
            if (response === '{"info":"email is invalid"}') {
                document.querySelector(".error-msg").textContent = "Email is invalid";
            }
        }
    }
</script>