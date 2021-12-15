<?php
$_title = 'acompany edit item';
require_once('components/header.php');

$itemApi = "http://localhost:8888/amazon/apis/api-item.php";
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
                <label>Item name</label>
                <input type="text" name="itemName" value="<?= $item['item_name'] ?>">
                <p class="error-msg error-first-name"></p>
            </div>
            <div id="item-description-con">
                <label>Item description</label>
                <textarea type="text" name="itemDesc"><?= $item['item_description'] ?></textarea>
                <p class="error-msg error-last-name"></p>
            </div>
            <div id="item-price-con">
                <label>Item price</label>
                <input type="text" name="itemPrice" placeholder=" " value="<?= $item['item_price'] ?>">
                <p class="error-msg error-email"></p>
            </div>
            <div id="item-image-con">
                <label>Item image</label>
                <input class="file-input" type="file" name="itemImg" id="image-upload">
                <div class="item-img-con">
                    <img src="./item_images/<?= $item['item_image'] ?>" />
                </div>

                <p class="error-msg error-img"></p>
            </div>
            <div class="update-profile-btn-con">
                <button class="update-profile-cancel button-disabled" onclick="resetForm()">Cancel</button>
                <button class="update-profile-button button-disabled" onclick="updateProfile()">Save</button>

            </div>
            <p class="success-msg update-item-response"></p>

        </form>
    </section>

</main>


<script>
    const itemForm = document.querySelector(".edit-item-form");
    const updateBtn = document.querySelector(".update-profile-button");
    const cancelBtn = document.querySelector(".update-profile-cancel");
    const successMsg = document.querySelector(".update-item-response");
    itemForm.addEventListener("input", enableBtns);

    document.querySelector("#image-upload").addEventListener("change", () => {
        document.querySelector(".item-img-con").classList.add("hide");
        console.log(document.querySelector("#image-upload"));

    });
    console.log(document.querySelector("#image-upload"));

    function enableBtns() {
        updateBtn.classList.remove("button-disabled");
        cancelBtn.classList.remove("button-disabled");
        itemForm.removeEventListener("input", enableBtns);
        successMsg.innerHTML = "";

    };

    async function resetForm() {
        const formData = new FormData(itemForm);
        formData.append('item_id', "<?= $_GET['id'] ?>")

        let conn = await fetch("./apis/api-item.php", {
            method: "POST",
            body: formData

        });
        let response = await conn.json();
        console.log(response)

        document.querySelector("#item-name-con input").value = response.item_name;
        document.querySelector("#item-description-con textarea").value = response.item_description;
        document.querySelector("#item-price-con input").value = response.item_price;
        document.querySelector(".item-img-con").classList.remove("hide");
        document.querySelector(".item-img-con img").src = `./item_images/${response.item_image} `;

        updateBtn.classList.add("button-disabled");
        cancelBtn.classList.add("button-disabled");
        itemForm.addEventListener("input", enableBtns);

    }

    async function updateProfile() {
        const formData = new FormData(itemForm);
        formData.append('itemId', "<?= $_GET['id'] ?>")


        if (document.querySelector("#image-upload").files.length == 0) {
            console.log("no files selected");
            formData.append('itemImg', "<?= $item['item_image'] ?>");

        }
        try {
            let conn = await fetch("./apis/api-edit-item.php", {
                method: "POST",
                body: formData
            });
            let response = await conn.json();
            console.log(response)
            if (!conn.ok) {
                const errorField = response.info.split(' ')[1].toLowerCase();
                console.log(errorField);
                const errorInput = document.querySelector(`#item-${errorField}-con input`)
                const errorMsg = document.querySelector(`#item-${errorField}-con .error-msg`)

                errorMsg.innerHTML = response.info;

            } else {
                successMsg.innerHTML = response.info;
                resetForm();
            }

        } catch (error) {
            console.error(error.message);
        }

    }
</script>
<?php
require_once('components/footer.php');
