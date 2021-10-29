<?php
$_title = 'Acompany Sign Up';
require_once('components/header.php');

?>

<main class="sign-up-main">
    <section class="sign-up-container">
        <form onsubmit="return false" class="sign-up-form">
            <h2>Create Account</h2>
            <label>First name</label>
            <input type="text" name="firstName" required>
            <label>Last name</label>
            <input type="text" name="lastName" required>
            <label>Email</label>
            <input type="text" name="email" required>
            <label>Phone number</label>
            <input id="noPhone" name="phoneNo" type="tel" maxlength="8" pattern="[0-9]{8}" required />
            <label>Password</label>
            <input type="text" name="password" required>
            <button onclick="signUp()">Sign up</button>
        </form>
    </section>
</main>

<script>
    async function signUp() {
        const form = document.querySelector(".sign-up-form");
        console.log(form)
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
