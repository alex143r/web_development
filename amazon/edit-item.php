<?php
$_title = 'acompany edit item';
require_once('components/header.php');

$itemApi = "http://localhost:8888/amazon/apis/api-edit-item.php";
function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'item_id=' . $_GET['id'] . '&method=post&access_token=xyz'); // define what you want to post
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
$item = json_decode(file_get_contents_curl($itemApi), true);
?>


<main class="profile-main">
    <section class="edit-item-con">
        <h2>Edit item</h2>
        <form onsubmit="return false" class="edit-item-form update-profile-form">
            <div id="item-name-con">
                <label>Iten name</label>
                <input type="text" name="firstName" value="<?= $item['item_name'] ?>">
                <p class="error-msg error-first-name"></p>
            </div>
            <div id="item-description-con">
                <label>Item description</label>
                <textarea type="text" name="lastName"><?= $item['item_description'] ?></textarea>
                <p class="error-msg error-last-name"></p>
            </div>
            <div id="item-price-con">
                <label>Item price</label>
                <input type="text" name="email" placeholder=" " value="<?= $item['item_price'] ?>">
                <p class="error-msg error-email"></p>
            </div>
            <div id="item-image-con">
                <label>Item image</label>
                <input class="file-input" type="file" name="itemImg">
                <div class="item-img-con">
                    <img src="./item_images/<?= $item['item_image'] ?>" />
                </div>

                <p class="error-msg error-img"></p>
            </div>
            <div class="update-profile-btn-con">
                <button class="update-profile-cancel button-disabled" onclick="resetForm()">Cancel</button>
                <button class="update-profile-button button-disabled" onclick="updateProfile()">Save</button>

            </div>
            <p class="update-profile-response"></p>

        </form>
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
            setTimeout(() => {
                window.location.href = "profile";
            }, 2000);
        } catch (error) {
            console.error(error.message);
        }

    }
</script>
<?php
require_once('components/footer.php');
