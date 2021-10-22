<?php
$_title = 'Amazing | Sign-In';
$_className = "signin";
require_once('components/header.php');
// require_once('apis/api-signup.php');

?>
<!-- Main HTML START -->
<header>
  <nav class="main-nav">
    <a href="index.php"><img class="logo" src="images/logo.svg" /></a>

    <input name="search" id="search" type="text" />

    <div class="log-in-container">
      <p>Hello, <span class="user-name">Sign in</span></p>
    </div>
    <div class="log-in-content">
      <span class="triangle"></span>

      <a href="sign-in"><button class="sign-in">Sign In</button></a>
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
<section class="main-content-form">
  <div class="logo-wrapper">
    <a href="index.php"><img class="logo-black" src="images/logo-black.svg" /></a>
  </div>

  <div class="form-wrapper">
    <h1>
      Sign-In
    </h1>
    <form id="form-sign-up" onsubmit="return false">
      <label for="name">Enter Email</label>
      <input name="name" type="text" placeholder="">

      <button class="sign-up-btn" onclick="sign_in()">Continue</button>

    </form>
    <div class="line-wrapper">
      <p>New to Amazing?</p>

    </div>
  
  </div>
  <div class="btn-wrapper">
  <button class="create-btn" onclick="location.href= 'sign-up.php'">Create your Amazing Account </button>
  </div>
</section>

<!-- Main HTML END  -->
<?php
require_once('components/footer.php');
?>

