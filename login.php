<?php
require_once('components/form-header.php');

$_title = 'acompany Log in';

if (isset($_SESSION['user_first_name'])) {
    header('Location: index');
}
?>

<main class="log-in-main">
    <div class="form-logo-container">
        <a href="./index"><img src="./img/logo_black.svg"></a>
    </div>
    <section class="log-in-container">
        <form onsubmit="return false" class="log-in-form">
            <h2>Login</h2>
            <div id="email-con">
                <label>Email</label>
                <input type="text" name="user_email" required>
                <p class="error-msg error-email"></p>

            </div>
            <div id="password-con">
                <label>Password</label>
                <input type="password" name="user_password" required>
                <p class="error-msg error-password"></p>
            </div>
            <button class="log-in-button" onclick="logIn()">Log in</button>
        </form>
        <p>Forgot password? <a href="./forgot-password.php">Click here</a>.</p>

        <p>Don't have an account? <a href="./sign-up.php">Create an account here</a>.</p>
    </section>
</main>

<script>
    async function logIn() {
        const form = document.querySelector(".log-in-form");
        try {
            let conn = await fetch("./apis/api-login.php", {
                method: "POST",
                body: new FormData(form)
            })
            let response = await conn.json();

            console.log(response)
            if (!conn.ok) {
                const errorField = response.info.split(' ')[0].toLowerCase();
                console.log(errorField);
                const errorInput = document.querySelector(`#${errorField}-con input`)
                const errorMsg = document.querySelector(`#${errorField}-con .error-msg`)

                errorInput.focus();
                errorMsg.innerHTML = response.info;

            } else {
                location.href = "index"
            }

        } catch (error) {
            console.error(error.message);
        }
    }
</script>
<?php
require_once('components/footer.php');
