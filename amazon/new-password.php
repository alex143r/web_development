<?php

session_start();
if ($_SESSION['is_verified']) {
    header('Location: index');
}
require_once(__DIR__ . '/globals.php');
$_title = 'Acompany Sign Up';
require_once('components/form-header.php');

?>


<main class="log-in-main">
    <div class="form-logo-container">
        <a href="./index.php"><img src="./img/logo_black.svg"></a>
    </div>
    <section class="log-in-container">
        <form onsubmit="return false" class="log-in-form hide">
            <h2>Reset password</h2>
            <div id="password-con">
                <label>New password</label>
                <input type="password" name="newPass" minlength="5" maxlength="20">
                <p class="error-msg error-new-pass"></p>
            </div>
            <div id="confirm-con">
                <label>Confirm new password</label>
                <input type="password" name="newPassConfirm" minlength="5" maxlength="20">
                <p class="error-msg confirm-confirm-new-pass"></p>
            </div>
            <button class="log-in-button" onclick="updatePass()">Update</button>
            <div class="success-update-pass hide">
                <p class="update-profile-response">New password updated! </p>
                <p><a href="login">Click here to log in!</a></p>
            </div>
        </form>
        <h4 class="wrong-key-new-pass-msg"></h4>

    </section>
</main>

</form>
</section>


<script>
    validatePassKey();

    function validatePassKey() {
        const key = "<?= $_GET['key'] ?>";
        const wrongKeyText = document.querySelector(".wrong-key-new-pass-msg");
        const passForm = document.querySelector("form");

        if (!key || key.length != 32) {
            wrongKeyText.innerHTML = "Wrong key";
        } else {

            wrongKeyText.classList.add("hide");
            passForm.classList.remove("hide");

        }


    }

    async function updatePass() {
        const passForm = document.querySelector("form");

        const formData = new FormData(passForm);
        const key = "<?= $_GET['key'] ?>";
        const wrongKeyText = document.querySelector(".wrong-key-new-pass-msg");
        formData.append('key', key);


        const conn = await fetch('./apis/api-new-password.php', {
            method: "POST",
            body: formData
        });
        const response = await conn.json();

        console.log(response)
        if (!conn.ok) {
            document.querySelectorAll(".error-msg").forEach((msg) => msg.innerHTML = '');
            document.querySelector(".success-update-pass").classList.add("hide");

            const errorField = response.info.split(' ')[0].toLowerCase();
            if (errorField == 'key') {
                document.querySelector(`#confirm-con .error-msg`).innerHTML = "Wrong key";

            } else {
                const errorInput = document.querySelector(`#${errorField}-con input`)
                const errorMsg = document.querySelector(`#${errorField}-con .error-msg`)

                errorMsg.innerHTML = response.info;
            }


        }
        if (conn.ok) {
            document.querySelector(".success-update-pass").classList.remove("hide");
        }
    }
</script>
<?php
require_once('components/footer.php');
