<?php
$_title = 'acompany';
require_once('components/header.php');
?>


<main class="profile-main">
    <section class="update-profile-con">
        <h2>Update profile settings</h2>
        <form onsubmit="return false" class="update-profile-form">
            <div id="first-name-con">
                <label>First name</label>
                <input type="text" name="firstName" value="<?= $_SESSION['user_first_name'] ?>">
                <p class="error-msg error-first-name"></p>
            </div>
            <div id="last-name-con">
                <label>Last name</label>
                <input type="text" name="lastName" value="<?= $_SESSION['user_last_name'] ?>">
                <p class="error-msg error-last-name"></p>
            </div>
            <div id="email-con">
                <label>Email</label>
                <input type="text" name="email" placeholder=" " value="<?= $_SESSION['user_email'] ?>">
                <p class="error-msg error-email"></p>
            </div>
            <div id="phone-no-con">
                <label>Phone number</label>
                <input id="noPhone" name="phoneNo" type="tel" maxlength="8" pattern="[0-9]{8}" tabindex="4" value="<?= $_SESSION['user_phone_number'] ?>">
                <p class="error-msg error-phone-no"></p>
            </div>
            <div class="update-profile-btn-con">
                <button class="update-profile-cancel button-disabled" onclick="resetForm()">Cancel</button>
                <button class="update-profile-button button-disabled" onclick="updateProfile()">Save</button>

            </div>
            <p class="update-profile-response"></p>

        </form>
    </section>
    <section class="update-profile-con update-profile-pass-con">
        <h2>Update password</h2>
        <div class="update-profile-pass">
            <label>Password:</label>
            <p>*********</p>
            <button class="edit-pass-btn">Edit</button>
        </div>
    </section>
</main>


<script>
    const profileForm = document.querySelector(".update-profile-form");
    const updateBtn = document.querySelector(".update-profile-button");
    const cancelBtn = document.querySelector(".update-profile-cancel");
    const successMsg = document.querySelector(".update-profile-response");
    profileForm.addEventListener("input", enableBtns);

    function enableBtns() {
        updateBtn.classList.remove("button-disabled");
        cancelBtn.classList.remove("button-disabled");
        profileForm.removeEventListener("input", enableBtns)
        successMsg.innerHTML = ""

    };

    function resetForm() {
        document.querySelector("#first-name-con input").value = "<?= $_SESSION['user_first_name'] ?>";
        document.querySelector("#last-name-con input").value = "<?= $_SESSION['user_last_name'] ?>";
        document.querySelector("#email-con input").value = "<?= $_SESSION['user_email'] ?>";
        document.querySelector("#phone-no-con input").value = "<?= $_SESSION['user_phone_number'] ?>";

        updateBtn.classList.add("button-disabled");
        cancelBtn.classList.add("button-disabled");
        profileForm.addEventListener("input", enableBtns);

    }

    async function updateProfile() {
        try {
            let conn = await fetch("./apis/api-update-profile.php", {
                method: "POST",
                body: new FormData(profileForm)
            });
            let response = await conn.json();
            successMsg.innerHTML = response.info;
            resetForm();
        } catch (error) {
            console.error(error.message);
        }

    }
</script>
<?php
require_once('components/footer.php');
