<?php
$_title = 'Acompany Sign Up';
require_once('components/form-header.php');

?>

<main class="log-in-main">
    <div class="form-logo-container">
        <a href="./index.php"><img src="./img/logo_black.svg"></a>
    </div>
    <section class="log-in-container">
        <form onsubmit="return false" class="log-in-form">
            <h2>Login</h2>
            <label>Email</label>
            <input type="text" name="user_email" required>
            <label>Password</label>
            <input type="text" name="user_password" required>
            <button class="log-in-button" onclick="logIn()">Log in</button>
        </form>
        <p>Forgot password? <a href="./forgot-password.php">Click here</a>.</p>

        <p>Don't have an account? <a href="./sign-up.php">Create an account here</a>.</p>
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

        console.log(response)
    }
</script>
<?php
require_once('components/footer.php');
