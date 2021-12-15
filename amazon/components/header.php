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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="app.css">
</head>

<body>


    <nav>
        <div class="primary-nav">
            <div id="slogan" href="index">
                <a href="index">
                    <img src="img/logo.svg">
                </a>
            </div>
            <div>

                <h4>deliver to <?= $_SESSION['user_first_name'] ?? "Denmark" ?></h4>
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
                <?php if (isset($_SESSION['user_first_name'])) {
                ?> <p onclick="location.href='login'">Hello, <?= $_SESSION['user_first_name']; ?>
                    <?php
                } else {
                    ?>
                    <p onclick="location.href='sign-up'">Hello, Sign in<?php
                                                                    } ?>
                    <h4>Account & Lists<span class="nav-icon nav-arrow" style="visibility: visible;"></span></h4>
                    </p>
                    <?php if (isset($_SESSION['user_first_name'])) { ?>
                        <div class="dropdown-modal log-in-modal">
                            <div class="modal-arrow"></div>
                            <div class="login-content">

                                <div class="your-account">
                                    <h3>Your account</h3>
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
            <div>Returns &amp; Order</div>
            <div>Cart</div>
        </div>
        <div class="secondary-nav"></div>
    </nav>