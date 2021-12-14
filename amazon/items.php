<?php
$_title = 'acompany your items';
require_once('components/header.php');
require_once(__DIR__ . '/globals.php');
if (!isset($_SESSION['user_first_name'])) {
    header('Location: index');
}
//require_once(__DIR__ . '/apis/api-items.php');
$data = json_decode(file_get_contents(__DIR__ . '/apis/api-items.php'));
echo $data;
?>
<section>
    <main class="your-items-con">
        <?php
        foreach ($data as $item) {
            echo "
        <div class='item'>
            <div>{$item}</div>
        </div>";
        };
        ?>
    </main>

</section>