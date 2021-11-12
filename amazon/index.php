<?php
// require_once('dictionary.php');
$lan = $_GET['lan'] ?? 'en';
// $_title = $text[2][$lan];
$_title = 'Acompany';
require_once('components/header.php');
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
$country = $details->country;
echo $country;
?>



<nav>
  <div class="primary-nav">
    <div id="slogan" href="index.php">
      <a href="index.php">
        <img src="img/logo.svg">
      </a>
    </div>
    <div>

      <p>deliver to <?= $_SESSION['user_name'] ?></p>
      <h4> <?= $country ?? "Denmark" ?></h4>
    </div>
    <div class="search-bar">
      <div class="search-fill"></div>
      <input class="search-text" type="text" />
      <div class="search-button">🔍</div>
    </div>
    <div class="language">
      <span class="flag">
        <?= $lan === 'dk' ? "🇩🇰" : '🇬🇧'  ?></span><span class="nav-icon nav-arrow" style="visibility: visible;"></span>
      <div class="language-switch">
        <p>Change language:</p>
        <form class="language-select">
          <input type="radio" id="en" name="language" value="en" <?= $lan == "en" ? "checked" : '' ?>>
          <label for="en">English 🇬🇧</label></br>
          <input type="radio" id="dk" name="language" value="dk" <?= $lan == "dk" ? "checked" : '' ?>>
          <label for="dk">Dansk 🇩🇰</label>
        </form>
      </div>
    </div>
    <div class="nav-account">
      <?php if (isset($_SESSION['user_name'])) {
      ?> <p onclick="location.href='login.php'">Hello, <?= $_SESSION['user_name']; ?>
        <?php
      } else {
        ?>
        <p onclick="location.href='sign-up.php'">Hello, Sign in<?php
                                                              } ?>
        <h4>Account & Lists<span class="nav-icon nav-arrow" style="visibility: visible;"></span></h4>
        </p>
        <?php if (isset($_SESSION['user_name'])) { ?>
          <div class="dropdown-modal log-in-modal">
            <div class="modal-arrow"></div>
            <div class="login-content">
              <div class="your-lists">
                <h3>Your lists</h3>
                <p><a href="/amazon/index.php">Create a list</a></p>
                <p><a href="/amazon/index.php">Create a list</a></p>
                <p><a href="/amazon/index.php">Create a list</a></p>

              </div>
              <div class="your-account">
                <h3>Your account</h3>
                <p><a href="/amazon/account.php">Account</a></p>
                <p><a href="/amazon/index.php">Orders</a></p>
                <p><a href="/amazon/index.php">Browsing history</a></p>
                <p><a href="./bridges/logout.php">Sign out</a></p>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="dropdown-modal">
            <div class="modal-arrow"></div>
            <div class="sign-in-modal">
              <a href="./login.php"><button class="sign-in-button">Sign in</button></a>
              <p>New customer? Create account <a href="./sign-up.php">here!</a></p>

            </div>
          </div>
        <?php } ?>

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
