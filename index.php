<?php

$_title = 'acompany frontpage';
require_once('components/header.php');
require_once(__DIR__ . '/globals.php');

//require tsv parser so we create a new shop.txt file and get updated content
require_once(__DIR__ . '/tsv-parser.php');

$partnerData = json_decode(file_get_contents(__DIR__ . "/shop.txt"));

$ourItemsApi = "http://localhost:8888/apis/api-items.php";
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
$ourItems = json_decode(file_get_contents_curl($ourItemsApi), true);


?>



<div>
  <main class="main-container">
    <h2>Featured Partner Products</h2>
    <section class="carousel frontpage-carousel carousel-slider center" data-indicators="true">
      <div class="carousel-fixed-item center middle-indicator">
        <div class="left">
          <a href="previous" class="movePrevCarousel middle-indicator-text waves-effect waves-light content-indicator"><i class="material-icons left  middle-indicator-text">chevron_left</i></a>
        </div>

        <div class="right">
          <a href="next" class=" moveNextCarousel middle-indicator-text waves-effect waves-light content-indicator"><i class="material-icons right middle-indicator-text">chevron_right</i></a>
        </div>
      </div>
      <?php
      foreach ($partnerData as $item) {
        echo "
      <a class='carousel-item' href=''>
          <div class='caro-img-con'>
            <img src='https://coderspage.com/2021-F-Web-Dev-Images/{$item->image}'>
          </div>
          <div class='caro-text-con'>
            <h4 class='caro-title'>{$item->title_en}</h4>
            <p class='caro-desc'>{$item->desc_en}</p>
            <p class='caro-price'>{$item->price_en} kr</p>
          </div>
      </a>";
      };
      ?>


    </section>
  </main>
  <section class="our-products">

    <div>
      <h2>Our Featured Products</h2>
      <main class="your-items-con">
        <?php

        foreach ($ourItems as $item) {
          echo "
                <div class='item'>
                    <div class='item-img-con'>
                        <img src='./item_images/{$item['item_image']}'/>
                    </div>
                    <div class='item-text-con'>
                        <h4 class='item-title'>{$item['item_name']}</h4>
                        <p class='item-description'>{$item['item_description']}</p>
                        <p class='item-price'>{$item['item_price']} kr</p>
                    </div>
                </div>";
        };
        ?>
      </main>

    </div>
  </section>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
  const elem = document.querySelector(".carousel");
  const options = {
    padding: 75,
    dist: 0,
  };
  instance = M.Carousel.init(elem, options);

  document.querySelector('.moveNextCarousel').addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();
    instance.next();
  });
  document.querySelector('.movePrevCarousel').addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();
    instance.prev();
  });

  document.querySelectorAll(".caro-desc").forEach((desc) => {
    if (desc.innerHTML.length > 110) {
      const shortenedDesc = desc.innerHTML.substring(0, 107) + '...';
      desc.innerHTML = shortenedDesc;
    }
  })
</script>
<?php
require_once('components/footer.php');
