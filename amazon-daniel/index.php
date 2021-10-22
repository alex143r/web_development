<?php
$_title = 'Amazing | Welcome';
require_once 'components/header.php';

?>

<!-- Main HTML START -->
<header>
    <nav class="main-nav">
        <a href="index.php"><img class="logo" src="images/logo.svg" /></a>

        <div class="search-wrapper">
            <input name="search" id="search" type="text" />
        </div>

        <div class="log-in-container">
            <p>Hello, <span class="user-name">Sign in</span></p>
        </div>

        <div class="log-in-content">
            <span class="triangle"></span>
            <a href="sign-in.php"><button class="sign-in">Sign In</button></a>
            <p class="new-user">New customer? <a href="sign-up.php">Start here</a></p>
        </div>

        <div class="shopping-cart">
            <img class="cart_img" src="images/cart.svg" alt="">
            <span class="cart-item-count">0</span>
            <p>Cart</p>
        </div>

    </nav>
    <nav class="sub-nav"></nav>
</header>

<div id="main-content-container">
    <section id="sidebar">left panel</section>
    <main id="products">
        <div class="item">
            <img src="https://m.media-amazon.com/images/I/817DclokSqL._AC_SX679_.jpg" alt="" />

            <div>
                <div>CanaKit Raspberry Pi 4 4GB Starter PRO Kit - 4GB RAM</div>

                <div>⭐⭐⭐⭐⭐ 8,265</div>

                <div>$99.99 <span class="old-price">$119.99</span></div>
                <div>Ships to Denmark</div>
                <div>More Buying Choices</div>
                <div>$91.99(7 used & new offers)</div>
            </div>
        </div>
        <div class="item">
            <img src="https://m.media-amazon.com/images/I/817DclokSqL._AC_SX679_.jpg" alt="" />

            <div>
                <div>CanaKit Raspberry Pi 4 4GB Starter PRO Kit - 4GB RAM</div>

                <div>⭐⭐⭐⭐⭐ 8,265</div>

                <div>$99.99 <span class="old-price">$119.99</span></div>
                <div>Ships to Denmark</div>
                <div>More Buying Choices</div>
                <div>$91.99(7 used & new offers)</div>
            </div>
        </div>
        <div class="item">
            <img src="https://m.media-amazon.com/images/I/817DclokSqL._AC_SX679_.jpg" alt="" />

            <div>
                <div>CanaKit Raspberry Pi 4 4GB Starter PRO Kit - 4GB RAM</div>

                <div>⭐⭐⭐⭐⭐ 8,265</div>

                <div>$99.99 <span class="old-price">$119.99</span></div>
                <div>Ships to Denmark</div>
                <div>More Buying Choices</div>
                <div>$91.99(7 used & new offers)</div>
            </div>
        </div>
    </main>
</div>

<!-- Main HTML END  -->
<?php
require_once 'components/footer.php';
?>