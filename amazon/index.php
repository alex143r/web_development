<?php
// require_once('dictionary.php');
//$lan = $_GET['lan'] ?? 'en';
// $_title = $text[2][$lan];
$_title = 'acompany';
require_once('components/header.php');
require_once(__DIR__ . '/globals.php');

//require tsv parser so we create a new shop.txt file and get updated content
require_once(__DIR__ . '/tsv-parser.php');

// $ip = $_SERVER['REMOTE_ADDR'];
// $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
// $country = $details->country;
// echo $country;
echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

$data = json_decode(file_get_contents(__DIR__ . "/apisshop.txt"));
// foreach ($data as $item) {
//   echo "
//         <div class='item'>
//             <div>{$item->id}</div>
//             <div>{$item->title}</div>
//             <img src='https://coderspage.com/2021-F-Web-Dev-Images/{$item->image}'>
//         </div>";
// };

?>



<!-- start div left and right -->
<div id="main-container">

  <!-- items will appear -->
  <main>
    <!-- blue printing -->
    <?php
    foreach ($data as $item) {
      echo "<div class='item'>
                <img src='https://coderspage.com/2021-F-Web-Dev-Images/{$item->image}'>
                <div>
                  <h4>{$item->title_en}</h4>
                  <p>{$item->desc_en}</p>
                  <p class='price'>{$item->price_gb} Dkk</p></div>
                </div>";
    };
    ?>
    <!-- 
    <div class="item">
      <img src="https://m.media-amazon.com/images/I/817DclokSqL._AC_UY436_QL65_.jpg" alt="" />
      <div>
        <div>CanaKit Raspberry Pi 4 8GB Starter Kit - 8GB RAM</div>
        <div>⭐⭐⭐⭐⭐ 8256</div>
        <div>$119</div>
        <div>Ships to Denmark</div>
        <div>More buying choices</div>
        <div>$110.39 (6 used &amp; new offers)</div>
      </div>
    </div>
    <div class="item">
      <img src="https://m.media-amazon.com/images/I/817DclokSqL._AC_UY436_QL65_.jpg" alt="" />
      <div>
        <div>CanaKit Raspberry Pi 4 8GB Starter Kit - 8GB RAM</div>
        <div>⭐⭐⭐⭐⭐ 8256</div>
        <div>$119</div>
        <div>Ships to Denmark</div>
        <div>More buying choices</div>
        <div>$110.39 (6 used &amp; new offers)</div>
      </div>
    </div>
    <div class="item">
      <img src="https://m.media-amazon.com/images/I/817DclokSqL._AC_UY436_QL65_.jpg" alt="" />
      <div>
        <div>CanaKit Raspberry Pi 4 8GB Starter Kit - 8GB RAM</div>
        <div>⭐⭐⭐⭐⭐ 8256</div>
        <div>$119</div>
        <div>Ships to Denmark</div>
        <div>More buying choices</div>
        <div>$110.39 (6 used &amp; new offers)</div>
      </div>
    </div>
    <div class="item">
      <img src="https://m.media-amazon.com/images/I/817DclokSqL._AC_UY436_QL65_.jpg" alt="" />
      <div>
        <div>CanaKit Raspberry Pi 4 8GB Starter Kit - 8GB RAM</div>
        <div>⭐⭐⭐⭐⭐ 8256</div>
        <div>$119</div>
        <div>Ships to Denmark</div>
        <div>More buying choices</div>
        <div>$110.39 (6 used &amp; new offers)</div>
      </div>
    </div>
    <div class="item">
      <img src="https://m.media-amazon.com/images/I/817DclokSqL._AC_UY436_QL65_.jpg" alt="" />
      <div>
        <div>CanaKit Raspberry Pi 4 8GB Starter Kit - 8GB RAM</div>
        <div>⭐⭐⭐⭐⭐ 8256</div>
        <div>$119</div>
        <div>Ships to Denmark</div>
        <div>More buying choices</div>
        <div>$110.39 (6 used &amp; new offers)</div>
      </div>
    </div> -->
  </main>
</div>
<!-- end div left and right -->

<script src="app.js"></script>
<?php
require_once('components/footer.php');
