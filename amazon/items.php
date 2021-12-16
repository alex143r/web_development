<?php
$_title = 'acompany your items';
require_once('components/header.php');
require_once(__DIR__ . '/globals.php');
// if (!isset($_SESSION['user_first_name'])) {
//     header('Location: index');
// }
//$data . items = json_decode(require_once(__DIR__ . '/apis/api-items.php'));
//$data = json_encode(require(__DIR__ . '/apis/api-items.php'));
// $json_data = file_get_contents($api);
// $response_data = json_decode($json_data);
// $items_data = $response_data;


// $data = (file_get_contents(__DIR__ . '/apis/api-items.php'));
// json_encode($data);
// echo $data;
// echo $url;
$itemApi = "http://localhost:8888/amazon/apis/api-user-items.php";
function file_get_contents_curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'user_id=' . $_SESSION['user_id'] . '&method=post&access_token=xyz'); // define what you want to post
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
$items = json_decode(file_get_contents_curl($itemApi), true);



?>
<section class="main-container">
    <main class="your-items-con">
        <?php

        foreach ($items as $item) {
            echo "
                <div class='item'>
                    <div class='item-img-con'>
                        <img src='./item_images/{$item['item_image']}'/>
                    </div>
                    <div class='item-text-con'>
                        <h4>{$item['item_name']}</h4>
                        <p class='item-description'>{$item['item_description']}</p>
                        <p>{$item['item_price']} kr</p>
                    </div>
                    <div class='edit-item-con'>
                            <a href='./edit-item?id={$item['item_id']}'>
                                <button class='edit-item-btn edit-pass-btn'>Edit</button>
                            </a>
                    </div>
                </div>";
        };
        ?>
    </main>

</section>
<script>
    document.querySelectorAll(".item-description").forEach((desc) => {

        if (desc.innerHTML.length > 100) {
            const shortenedDesc = desc.innerHTML.substring(0, 97) + '...';
            desc.innerHTML = shortenedDesc;
        }
    })
</script>

<?php
require_once('components/footer.php');
