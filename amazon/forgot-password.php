<?php
$_title = 'acompany forgot password';
require_once('components/form-header.php');

?>

<main class="forgot-password-main">
    <div class="form-logo-container">
        <a href="./index"><img src="./img/logo_black.svg"></a>
    </div>
    <section class="forgot-password-container">
        <form onsubmit="return false" class="forgot-password-form">
            <h2>Reset password</h2>
            <label>Email</label>
            <input type="text" name="user_email">
            <p class="error-msg"></p>

            <button class="forgot-password-button" onclick="forgotPassword()">Reset password</button>
            <p class="success-msg"></p>
        </form>
    </section>
</main>

<script>
    async function forgotPassword() {
        try {
            const form = document.querySelector(".forgot-password-form");
            let conn = await fetch("./apis/api-forgot-password.php", {
                method: "POST",
                body: new FormData(form)
            })
            let response = await conn.json();
            if (conn.ok) {
                document.querySelector(".success-msg").innerHTML = `${response.info}! Check your inbox.`;

                document.querySelector(".error-msg").innerHTML = '';
            }
            if (!conn.ok) {
                document.querySelector(".error-msg").innerHTML = response.info;
                document.querySelector(".success-msg").innerHTML = '';
            }
            console.log(response)
        } catch (error) {
            console.error(error);
        }
    }
</script>
<?php
require_once('components/footer.php');
