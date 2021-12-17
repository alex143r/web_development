<?php
$_title = 'acompany';
require_once('components/header.php');
if (!isset($_SESSION['user_first_name'])) {
    header('Location: index');
}
?>


<main class="account-main">
    <section class="update-account-con">
        <div class="breadcrumbs">
            <a href="/account">Account settings</a>
            <span>></span>
            <p>Update password</p>
        </div>
        <h2>Update password</h2>
        <form onsubmit="return false" class="update-account-form">
            <div id="old-pass-con">
                <label>Old password</label>
                <input type="password" name="oldPass" minlength="5" maxlength="20">
                <p class="error-msg error-old-pass"></p>
            </div>
            <div id="new-pass-con">
                <label>New password</label>
                <input type="password" name="newPass" minlength="5" maxlength="20">
                <p class="error-msg error-new-pass"></p>
            </div>
            <div id="new-pass-confirm-con">
                <label>Reenter new password</label>
                <input type="password" name="newPassConfirm" minlength="5" maxlength="20">
                <p class="error-msg error-new-pass-confirm"></p>
            </div>
            <div class="update-account-btn-con">
                <button class="update-account-cancel button-disabled" onclick="resetForm()">Cancel</button>
                <button class="update-account-button button-disabled" onclick="updatePassword()">Save</button>

            </div>
            <p class="update-account-response"></p>

        </form>
    </section>

</main>


<script>
    const passwordForm = document.querySelector(".update-account-form");
    const updateBtn = document.querySelector(".update-account-button");
    const cancelBtn = document.querySelector(".update-account-cancel");
    const successMsg = document.querySelector(".update-account-response");
    passwordForm.addEventListener("input", enableBtns);

    function enableBtns() {
        updateBtn.classList.remove("button-disabled");
        cancelBtn.classList.remove("button-disabled");
        passwordForm.removeEventListener("input", enableBtns)
        successMsg.innerHTML = ""

    };

    function resetForm() {
        document.querySelector("#old-pass-con input").value = "";
        document.querySelector("#new-pass-con input").value = "";
        document.querySelector("#new-pass-confirm-con input").value = "";

        updateBtn.classList.add("button-disabled");
        cancelBtn.classList.add("button-disabled");
        passwordForm.addEventListener("input", enableBtns);

    }

    async function updatePassword() {
        try {
            let conn = await fetch("./apis/api-update-password.php", {
                method: "POST",
                body: new FormData(passwordForm)
            });
            let response = await conn.json();
            console.log(response)
            if (!conn.ok) {
                successMsg.innerHTML = response.info;
                successMsg.classList.add("error-msg");
            } else {
                successMsg.innerHTML = response.info;
                successMsg.classList.remove("error-msg");
            }
            // setTimeout(() => {
            //     window.location.href = "account";
            // }, 2000);
        } catch (error) {
            console.error(error.message);
        }

    }
</script>
<?php
require_once('components/footer.php');
