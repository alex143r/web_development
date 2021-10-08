<?php
$_title = 'Sign up';
require_once('components/header.php');
?>
<h1>signup</h1>
<form id="form_sign_up" onsubmit="return false">
    <input name="name" type="text" placeholder="name">
    <input name="lastName" type="text" placeholder="last name">
    <input name="email" type="text" placeholder="email">
    <button onclick="signUp()">Sign up</button>
</form>
<script>
    async function signUp() {
        let conn = await fetch("api-signup.php", {
            method: "POST",
            body: new FormData(document.querySelector("#form_sign_up"))
        })
        let response = await conn.json();
        console.log(response)
    }
</script>
<?php require_once('components/footer.php');
