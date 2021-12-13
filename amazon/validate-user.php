<?php

session_start();
if ($_SESSION['is_verified']) {
    header('Location: index');
}
require_once(__DIR__ . '/globals.php');
$_title = 'Acompany Sign Up';
require_once('components/form-header.php');

?>
<section class="validate-email-container">

    <article class="validate-email">
        <div class="form-logo-container">
            <a href="./index.php"><img src="./img/logo_black.svg"></a>
        </div>
        <p class="validate-info-text">Verifying</p>
        <p class="redirect-info"></p>

    </article>
</section>

<script>
    validateUser();
    async function validateUser() {
        const formData = new FormData();
        const key = "<?= $_GET['key'] ?>";
        const validateText = document.querySelector(".validate-info-text");
        const redirectInfo = document.querySelector(".redirect-info");

        if (!key || key.length != 32) {
            validateText.innerHTML = "Suspicious";
        }
        formData.append('key', key);


        const conn = await fetch('./apis/api-validate-user.php', {
            method: "POST",
            body: formData
        });
        const response = await conn.json();


        validateText.innerHTML = response.info;
        console.log(response)

        if (conn.ok) {
            validateText.style.color = "#05CD05";
            redirectInfo.innerHTML = "Redirecting to login..."
            setTimeout(() => {
                window.location.href = "login";
            }, 4000);
        }

    }
</script>
<?php
require_once('components/footer.php');
