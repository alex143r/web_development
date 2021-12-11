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
        <p class="verify-email-info"></p>
        <p class="validate-info-text">Verifying</p>
    </article>
</section>

<script>
    validateUser();
    async function validateUser() {
        const formData = new FormData();
        const key = "<?= $_GET['key'] ?>";
        const validateText = document.querySelector(".validate-info-text");

        if (!key || key.length != 32) {
            validateText.innerHTML = "Suspicious";
        }
        formData.append('key', key);

        try {
            const request = await fetch('./apis/api-validate-user.php', {
                method: "POST",
                body: formData
            });
            const response = await request.json();

            validateText.innerHTML = response.info;

            if (request.ok) {
                infoElement.id = 'success';
                setTimeout(() => {
                    window.location.href = "login";
                }, 5000);
            }

        } catch (error) {
            console.error(error.message)
        }
    }
</script>
<?php
require_once('components/footer.php');
