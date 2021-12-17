<?php
$_title = 'acompany';
require_once('components/header.php');
if (!isset($_SESSION['user_first_name'])) {
    header('Location: index');
}
?>


<main class="account-main">
    <section class="update-account-con">
        <h2>Update account settings</h2>
        <form onsubmit="return false" class="update-account-form">
            <div id="first-con">
                <label>First name</label>
                <input type="text" name="firstName" value="<?= $_SESSION['user_first_name'] ?>">
                <p class="error-msg error-first-name"></p>
            </div>
            <div id="last-con">
                <label>Last name</label>
                <input type="text" name="lastName" value="<?= $_SESSION['user_last_name'] ?>">
                <p class="error-msg error-last-name"></p>
            </div>
            <div id="email-con">
                <label>Email</label>
                <input type="text" name="email" placeholder=" " value="<?= $_SESSION['user_email'] ?>">
                <p class="error-msg error-email"></p>
            </div>
            <div id="phone-con">
                <label>Phone number</label>
                <input id="noPhone" name="phoneNo" type="tel" maxlength="8" pattern="[0-9]{8}" tabindex="4" value="<?= $_SESSION['user_phone_number'] ?>">
                <p class="error-msg error-phone-no"></p>
            </div>
            <div class="update-account-btn-con">
                <button class="update-account-cancel button-disabled" onclick="resetForm()">Cancel</button>
                <button class="update-account-button button-disabled" onclick="updateaccount()">Save</button>

            </div>


            <p class="update-account-response"></p>
            <span id="account-con">
                <p class="error-msg"></p>
            </span>
        </form>
    </section>
    <section class="update-account-con update-account-pass-con">
        <h2>Update password</h2>
        <div class="update-account-pass">
            <label>Password:</label>
            <p>*********</p>
            <a href="./update-password">
                <button class="edit-pass-btn">Edit</button></a>
        </div>
    </section>
</main>


<script>
    const accountForm = document.querySelector(".update-account-form");
    const updateBtn = document.querySelector(".update-account-button");
    const cancelBtn = document.querySelector(".update-account-cancel");
    const successMsg = document.querySelector(".update-account-response");
    accountForm.addEventListener("input", enableBtns);

    function enableBtns() {
        updateBtn.classList.remove("button-disabled");
        cancelBtn.classList.remove("button-disabled");
        accountForm.removeEventListener("input", enableBtns)
        successMsg.innerHTML = ""

    };

    function resetForm() {
        document.querySelector("#first-con input").value = "<?= $_SESSION['user_first_name'] ?>";
        document.querySelector("#last-con input").value = "<?= $_SESSION['user_last_name'] ?>";
        document.querySelector("#email-con input").value = "<?= $_SESSION['user_email'] ?>";
        document.querySelector("#phone-con input").value = "<?= $_SESSION['user_phone_number'] ?>";

        updateBtn.classList.add("button-disabled");
        cancelBtn.classList.add("button-disabled");
        accountForm.addEventListener("input", enableBtns);
        document.querySelectorAll(".error-msg").forEach((msg) => msg.innerHTML = "")


    }

    async function updateaccount() {
        try {
            let conn = await fetch("./apis/api-update-account.php", {
                method: "POST",
                body: new FormData(accountForm)
            });
            let response = await conn.json();
            console.log(response)
            if (!conn.ok) {
                let errorField = response.info.split(' ')[0].toLowerCase();

                const errorInput = document.querySelector(`#${errorField}-con input`)
                const errorMsg = document.querySelector(`#${errorField}-con .error-msg`)

                errorMsg.innerHTML = response.info;

            } else {
                successMsg.innerHTML = response.info;
                updateBtn.classList.add("button-disabled");
                cancelBtn.classList.add("button-disabled");
                document.querySelectorAll(".error-msg").forEach((msg) => msg.innerHTML = "")
                setTimeout(() => {
                    window.location.href = "account";
                }, 1000);
            }

        } catch (error) {
            console.error(error.message);
        }

    }
</script>
<?php
require_once('components/footer.php');
