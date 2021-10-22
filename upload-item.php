<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="upload-item.css">
</head>

<body>

    <form onsubmit="validate(upload_item); return false">
        <input id="item_name" name="item_name" type="text" data-validate="str" data-min="2" data-max="20">
        <button>Upload item</button>
    </form>
    <div class="items"></div>
    <script src="validator.js"></script>
    <script>
        async function upload_item() {
            const form = event.target;
            const conn = await fetch('apis/api-upload-item', {
                method: "POST",
                body: new FormData(form)
            })
            const res = await conn.text();

            const itemName = document.querySelector("#item_name").value;
            const str = res;
            const idFromStr = str.substring(str.indexOf("id ") + 3);

            let divItem = `<div class="item">
                             <p>${itemName}</p>
                             <p>${idFromStr}</p>
                             <div onclick="deleteItem()">🗑️</div>
                             </div>`;
            document.querySelector(".items").insertAdjacentHTML("afterbegin", divItem);

        }

        async function deleteItem() {
            event.target.parentElement.remove();
            const itemId = event.target.previousElementSibling.innerHTML;
            const formData = new FormData();
            formData.append("item_id", itemId);


            const conn = await fetch('apis/api-delete-item', {
                method: "POST",
                body: formData
            })
            const res = await conn.text();

            console.log(res);
        }
    </script>
</body>

</html>