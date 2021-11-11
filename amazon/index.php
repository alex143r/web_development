<?php
// require_once('dictionary.php');
// $lan = $_GET['lan'] ?? 'en';
// $_title = $text[2][$lan];
$_title = 'Acompany';
require_once('components/header.php');


?>



<nav>
  <div class="primary-nav">
    <div id="slogan">amazon</div>
    <div>deliver to Denmark</div>
    <div>
      <input type="text" />
    </div>
    <div>🏁</div>
    <div>
      <?php if (isset($_SESSION['user_name'])) {
      ?> <p onclick="location.href='login.php'">Hello, <?= $_SESSION['user_name']; ?>
        <h3>Account & Lists</h3> <?php
                                } else {
                                  ?>
        <p onclick="location.href='sign-up.php'">Sign up<?php
                                                      } ?>
          <span class="nav-icon nav-arrow" style="visibility: visible;"></span>
        </p>
        <div class="sign-in-modal" style="display:none">
          <div class="modal-arrow"></div>
        </div>
    </div>
    <div>Returns &amp; Order</div>
    <div>Cart</div>
  </div>
  <div class="secondary-nav"></div>
</nav>

<!-- start div left and right -->
<div id="main-container">
  <section><?php
            if (isset($_SESSION['user_name'])) {
              echo "Hi " . $_SESSION['user_name'];
            } else {
              echo "Left panel";
            } ?> </section>

  <!-- items will appear -->
  <main>
    <!-- blue printing -->
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
    </div>
  </main>
</div>
<!-- end div left and right -->

<script src="app.js"></script>
<?php
require_once('components/footer.php');
