<?php
$_title = 'acompany Sign Up';
require_once('components/form-header.php');
if (isset($_SESSION['user_first_name'])) {
    header('Location: index');
}
?>

<main class="sign-up-main">
    <div class="form-logo-container">
        <a href="./index.php"><img src="./img/logo_black.svg"></a>
    </div>
    <section class="sign-up-container">
        <form onsubmit="return false" class="sign-up-form">
            <h2>Create Account</h2>
            <div id="first-con">
                <label>First name</label>
                <input type="text" id="firstName" name="firstName" minlength="2" maxlength="50" tabindex="1">
                <p class="error-msg error-fname"></p>
            </div>
            <div id="last-con">
                <label>Last name</label>
                <input type="text" name="lastName" minlength="2" maxlength="50" tabindex="2">
                <p class="error-msg error-lname"></p>

            </div>
            <div id="email-con">
                <label>Email</label>
                <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" tabindex="3">
                <p class="error-msg error-email"></p>
            </div>
            <div id="phone-con">
                <label>Phone number</label>
                <input id="noPhone" name="phoneNo" type="tel" maxlength="8" pattern="[0-9]{8}" tabindex="4" />
                <p class="error-msg error-phone"></p>

            </div>
            <div id="password-con">
                <label>Password</label>
                <input type="password" minlength="5" maxlength="20" name="password" tabindex="5">
                <p class="error-msg error-password"></p>

            </div>
            <button class="sign-up-button" onclick="signUp()">Sign up</button>
            <p class="sign-up-success-msg"></p>
        </form>
        <p>Already have an account? <a href="./login.php">Sign in here</a>.</p>
    </section>
</main>

<script>
    async function signUp() {
        const form = document.querySelector(".sign-up-form");
        try {
            let conn = await fetch("./apis/api-signup.php", {
                method: "POST",
                body: new FormData(form)
            })

            let response = await conn.json();
            console.log(response)
            if (!conn.ok) {
                const errorField = response.info.split(' ')[0].toLowerCase();
                const errorInput = document.querySelector(`#${errorField}-con input`)
                const errorMsg = document.querySelector(`#${errorField}-con .error-msg`)

                errorInput.focus();
                errorMsg.innerHTML = response.info;
                errorInput.addEventListener("blur", function() {
                    errorInput.style.outline = "none";
                    errorMsg.innerHTML = "";
                })
            } else {
                document.querySelector(".sign-up-success-msg").innerHTML = "Account created! Check your email to verify your account.";
            }

        } catch (error) {
            console.error(error.message);
        }

    }
</script>
<?php
require_once('components/footer.php');
