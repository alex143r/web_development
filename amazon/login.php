<?php
$_title = 'Acompany Sign Up';
require_once('components/header.php');

?>

<main class="log-in-main">
    <section class="log-in-container">
        <form onsubmit="return false" class="log-in-form">
            <h2>Login</h2>
            <label>Email</label>
            <input type="text" name="user_email" required>
            <label>Password</label>
            <input type="text" name="user_password" required>
            <button onclick="logIn()">Log in</button>
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
