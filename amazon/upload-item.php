<?php
$_title = 'acompany';
require_once('components/header.php');
require_once(__DIR__ . '/globals.php');

// if no session/user isnt logged in, go to inddex
if (!isset($_SESSION['user_first_name'])) {
    header('Location: index');
}
?>
<section>
    <main class="profile-main">
        <section class="update-profile-con">
            <h2>Upload an item</h2>
            <form onsubmit="return false" class="upload-item-form update-profile-form">
                <div id="item-name-con">
                    <label>Item name</label>
                    <input type="text" name="itemName">
                    <p class="error-msg error-name"></p>
                </div>
                <div id="item-description-con">
                    <label>Item description</label>
                    <textarea type="textarea" name="itemDesc" place></textarea>
                    <p class="error-msg error-description"></p>
                </div>
                <div id="item-price-con">
                    <label>Price of item in kr</label>
                    <input type="number" min="1" name="itemPrice" step=".01" placeholder=" ">
                    <p class="error-msg error-price"></p>
                </div>
                <div id="item-image-con">
                    <label>Upload an image of item</label>
                    <input class="file-input" type="file" name="itemImg">
                    <p class="error-msg error-img"></p>
                </div>
                <div class="update-profile-btn-con">
                    <button class="update-profile-cancel button-disabled" onclick="resetForm()">Cancel</button>
                    <button class="update-profile-button button-disabled" onclick="uploadItem()">Upload</button>

                </div>
                <p class="success-msg"></p>
                <p class="msg-check-out-items hide">Go to your <a href="/amazon/items">items</a>.</p>


            </form>
        </section>
        <script>
            const itemForm = document.querySelector(".upload-item-form");
            const updateBtn = document.querySelector(".update-profile-button");
            const cancelBtn = document.querySelector(".update-profile-cancel");
            const successMsg = document.querySelector(".success-msg");

            itemForm.addEventListener("input", enableBtns);

            function enableBtns() {
                updateBtn.classList.remove("button-disabled");
                cancelBtn.classList.remove("button-disabled");
                itemForm.removeEventListener("input", enableBtns)
                successMsg.innerHTML = "";

            };

            function resetForm() {
                document.querySelectorAll(`.upload-item-form input`).forEach((label) => {
                    label.value = '';
                });
                document.querySelector(`.upload-item-form textarea`).value = "";
                document.querySelectorAll(".error-msg").forEach((msg) => msg.innerHTML = '');

                itemForm.addEventListener("input", enableBtns);

            }

            async function uploadItem() {
                try {
                    let conn = await fetch("./apis/api-upload-item.php", {
                        method: "POST",
                        body: new FormData(itemForm)
                    });
                    let response = await conn.json();
                    console.log(response)

                    if (!conn.ok) {
                        document.querySelectorAll(".error-msg").forEach((msg) => msg.innerHTML = '');
                        const errorField = response.info.split(' ')[1].toLowerCase();
                        const errorInput = document.querySelector(`#item-${errorField}-con input`)
                        const errorMsg = document.querySelector(`#item-${errorField}-con .error-msg`)
                        errorMsg.innerHTML = response.info;
                    }
                    if (conn.ok) {
                        document.querySelector(".success-msg").innerHTML = response.info;
                        document.querySelector(".msg-check-out-items").classList.remove("hide");
                        resetForm();
                    }

                } catch (error) {
                    console.error(error.message);
                }
            }
        </script>
        <?php
        require_once('components/footer.php');
