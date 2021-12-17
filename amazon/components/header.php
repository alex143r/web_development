<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?? 'acompany' ?></title>
    <link rel="stylesheet" href="./css/materialize.min.css">
    <link rel="icon" type="image/svg+xml" href="./img/small-logo.svg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    </script>

</head>

<body>


    <nav>
        <div class="primary-nav">
            <div id="slogan" href="index">
                <a href="index" class="logo-con">
                    <img src="img/logo.svg">
                </a>
            </div>
            <div class="disabled">

                <p class="delivery">deliver to <?= $_SESSION['user_first_name'] ?? "Denmark" ?></p>
            </div>
            <div class="search-bar">
                <div class="search-fill"></div>
                <input class="search-text" type="text" />
                <div class="search-button">🔍</div>
            </div>
            <div class="language">
                <span class="flag">
                    <?= $lan === 'dk' ? "🇩🇰" : '🇬🇧'  ?></span>
                <!--    <span class="nav-icon nav-arrow" style="visibility: visible;"></span>
                 <div class="language-switch">
                    <p>Change language:</p>
                    <form class="language-select">
                        <input type="radio" id="en" name="language" value="en" <?= $lan == "en" ? "checked" : '' ?>>
                        <label for="en">English 🇬🇧</label></br>
                        <input type="radio" id="dk" name="language" value="dk" <?= $lan == "dk" ? "checked" : '' ?>>
                        <label for="dk">Dansk 🇩🇰</label>
                    </form>
                </div> -->
            </div>
            <div class="nav-account">
                <?php if (isset($_SESSION['user_first_name'])) {
                ?> <p onclick="location.href='login'">Hello, <?= $_SESSION['user_first_name']; ?>
                    <?php
                } else {
                    ?>
                    <p onclick="location.href='sign-up'">Hello, Sign in<?php
                                                                    } ?> </p>
                    <h4>Account<span class="nav-icon nav-arrow" style="visibility: visible;"></span></h4>

                    <?php if (isset($_SESSION['user_first_name'])) { ?>
                        <div class="dropdown-modal log-in-modal">
                            <div class="modal-arrow"></div>
                            <div class="login-content">

                                <div class="your-account">
                                    <h3>Your Account</h3>
                                    <p><a href="/amazon/profile">Account</a></p>
                                    <p><a href="/amazon/upload-item">Upload items</a></p>
                                    <p><a href="/amazon/items">Your items</a></p>
                                    <p><a href="./bridges/logout">Sign out</a></p>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="dropdown-modal">
                            <div class="modal-arrow"></div>
                            <div class="sign-in-modal">
                                <a href="./login"><button class="sign-in-button">Sign in</button></a>
                                <p>New customer? Create account <a href="./sign-up">here!</a></p>

                            </div>
                        </div>
                    <?php } ?>

            </div>
            <div class="returns disabled">
                <h4>
                    Returns &amp; Order
                </h4>
            </div>
            <div class="cart disabled">
                <h4>
                    Cart
                </h4>
            </div>
            <div class="burgermenu-icon sidenav-trigger" data-target="mobile-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>

        </div>
        <ul class="sidenav" id="mobile-menu">
            <?php if (isset($_SESSION['user_first_name'])) { ?>

                <li><a href="/amazon/profile">Account</a></li>
                <li><a href="/amazon/upload-item">Upload items</a></li>
                <li><a href="/amazon/items">Your items</a></li>
                <li><a href="./bridges/logout">Sign out</a></li>

            <?php } else { ?>
                <li><a href="./login">Sign in</a></li>
                <li><a href="./sign-up">Create account</a></li>


            <?php }; ?>

        </ul>
        <div class="sidenav-overlay"></div>
    </nav>