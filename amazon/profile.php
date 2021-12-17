<?php
$_title = 'acompany';
require_once('components/header.php');
if (!isset($_SESSION['user_first_name'])) {
    header('Location: index');
}
?>


<main class="profile-main">
    <section class="update-profile-con">
        <h2>Update profile settings</h2>
        <form onsubmit="return false" class="update-profile-form">
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
            <div class="update-profile-btn-con">
                <button class="update-profile-cancel button-disabled" onclick="resetForm()">Cancel</button>
                <button class="update-profile-button button-disabled" onclick="updateProfile()">Save</button>

            </div>


            <p class="update-profile-response"></p>
            <span id="profile-con">
                <p class="error-msg"></p>
            </span>
        </form>
    </section>
    <section class="update-profile-con update-profile-pass-con">
        <h2>Update password</h2>
        <div class="update-profile-pass">
            <label>Password:</label>
            <p>*********</p>
            <a href="./update-password">
                <button class="edit-pass-btn">Edit</button></a>
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
        document.querySelector("#first-con input").value = "<?= $_SESSION['user_first_name'] ?>";
        document.querySelector("#last-con input").value = "<?= $_SESSION['user_last_name'] ?>";
        document.querySelector("#email-con input").value = "<?= $_SESSION['user_email'] ?>";
        document.querySelector("#phone-no-con input").value = "<?= $_SESSION['user_phone_number'] ?>";

        updateBtn.classList.add("button-disabled");
        cancelBtn.classList.add("button-disabled");
        profileForm.addEventListener("input", enableBtns);
        document.querySelectorAll(".error-msg").forEach((msg) => msg.innerHTML = "")


    }

    async function updateProfile() {
        try {
            let conn = await fetch("./apis/api-update-profile.php", {
                method: "POST",
                body: new FormData(profileForm)
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
                    window.location.href = "profile";
                }, 2000);
            }

        } catch (error) {
            console.error(error.message);
        }

    }
</script>
<?php
require_once('components/footer.php');
