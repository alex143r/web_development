<?php
$_title = 'acompany forgot password';
require_once('components/form-header.php');

?>

<main class="forgot-password-main">
    <div class="form-logo-container">
        <a href="./index.php"><img src="./img/logo_black.svg"></a>
    </div>
    <section class="forgot-password-container">
        <form onsubmit="return false" class="forgot-password-form">
            <h2>Reset password</h2>
            <label>Email</label>
            <input type="text" name="user_email" required>
            <button class="forgot-password-button" onclick="logIn()">Reset password</button>
        </form>
    </section>
</main>

<script>
    async function logIn() {
        const form = document.querySelector(".log-in-form");
        let conn = await fetch("./apis/api-login.php", {
            method: "POST",
            body: new FormData(form)
        })
        let response = await conn.text();
        if (conn.ok) {
            location.href = "index.php";
        }
        console.log(response)
    }
</script>
<?php
require_once('components/footer.php');
