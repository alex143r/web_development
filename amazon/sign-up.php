<?php
$_title = 'Acompany Sign Up';
require_once('components/form-header.php');

?>

<main class="sign-up-main">
    <div class="form-logo-container">
        <a href="./index.php"><img src="./img/logo_black.svg"></a>
    </div>
    <section class="sign-up-container">
        <form onsubmit="return false" class="sign-up-form">
            <h2>Create Account</h2>
            <label>First name</label>
            <input type="text" name="firstName" minlength="2" maxlength="50" tabindex="1" required>
            <label>Last name</label>
            <input type="text" name="lastName" minlength="2" maxlength="50" tabindex="2" required>
            <label>Email</label>
            <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" tabindex="3" required>
            <label>Phone number</label>
            <input id="noPhone" name="phoneNo" type="tel" maxlength="8" pattern="[0-9]{8}" tabindex="4" required />
            <label>Password</label>
            <input type="password" minlength="5" maxlength="20" name="password" tabindex="5" required>
            <button class="sign-up-button" onclick="signUp()">Sign up</button>
        </form>
        <p>Already have an account? <a href="./login.php">Sign in here</a>.</p>
    </section>
</main>

<script>
    async function signUp() {
        const form = document.querySelector(".sign-up-form");
        let conn = await fetch("./apis/api-signup.php", {
            method: "POST",
            body: new FormData(form)
        })
        let response = await conn.text();
        console.log(response)
    }
</script>
<?php
require_once('components/footer.php');
