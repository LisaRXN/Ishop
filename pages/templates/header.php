<?php
session_start();
$log = "login";

if ($_SESSION) {
  $users_table = new User();
  $user = $users_table->getByEmail($_SESSION['email']);
  $username = ucfirst($user->username);
  $log = 'logout';
  $welcome = "Welcome $username";

  if ($user->avatar != null) {
    $avatar = $user->avatar;
  } else {
    $avatar = "/img/icons/icon-profile.png";
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Web Design</title>
  <link rel="stylesheet" href="/public/reset.css" />
  <link rel="stylesheet" href="/public/style.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <!-- <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
      rel="stylesheet"
    /> -->
</head>

<body>
  <div class="website-container">

    <nav id="navigation">
      <div class="nav-content-left">
        <a href="/index.php?p=home" class="nav-content-logo"><img class="navbar-logo" src="/img/Logo.png" /></a>

        <div class="nav-links">
          <?php if ($_SESSION['admin'] == 1): ?>
            <a href="/index.php?p=admin" class="nav-link nav-link-admin ">ADMIN</a>
          <?php endif ?>
          <a href="/index.php?p=home" class="nav-link">HOME</a>
          <a href="/index.php?p=shop" class="nav-link">SHOP</a>
          <a href="/index.php?p=magazine" class="nav-link">MAGAZINE</a>
          <a href="/index.php?p=<?php echo $log ?>" class="nav-link nav-link-mobile"><?php echo $log ?></a>
        </div>

        <!-- Navigation MOBILE -->
        <div class="nav-links nav-modal">

          <?php if ($_SESSION['admin'] == 1): ?>
            <div class="nav-modal-link"><a href="/index.php?p=admin" class="nav-link nav-link-admin ">ADMIN</a>
              <p>></p>
            </div>
          <?php endif ?>
          <div class="nav-modal-link <?= $_GET['p'] == "home" ? 'link-hidden' : 'link-active' ?> ">
            <a href="/index.php?p=home" class="nav-link">HOME</a>
            <p>></p>
            </div>
            <div class="nav-modal-link <?= $_GET['p'] == "shop" ? 'link-hidden' : 'link-active' ?> ">
              <a href="/index.php?p=shop" class="nav-link">SHOP</a>
              <p>></p>
            </div>
            <div class="nav-modal-link <?= $_GET['p'] == "magazine" ? 'link-hidden' : 'link-active' ?>">
              <a href="/index.php?p=magazine" class="nav-link">MAGAZINE</a>
              <p>></p>
            </div>
            <div class="nav-modal-link <?= $_GET['p'] == "cart" ? 'link-hidden' : 'link-active' ?>"><a
                href="/index.php?p=cart" class="nav-link">CART</a>
              <p>></p>
            </div>
            <div class="nav-modal-link <?= $_GET['p'] == $log ? 'link-hidden' : 'link-active' ?>"><a
                href="/index.php?p=<?php echo $log ?>" class="nav-link nav-link-mobile"><?php echo $log ?></a>
              <p>></p>
            </div>
          </div>
          <!-- END Navigation MOBILE -->



        </div>
        <div class="nav-content-right">
          <p class="nav-welcome"><?php echo $welcome; ?></p>

          <div class="navbar-avatar-container"><a href="index.php/?p=my_account"> <img class="navbar-avatar-button"
                src="<?= $avatar ?>" /></a></div>

          <div class="navbar-cart-container"><a href="/index.php?p=cart"> <img class="navbar-cart-button"
                src="/img/Cart_Button.png" /></a></div>
          <img class="navbar-login-button" src="/img/login-logo.png" />
          <a href="/index.php?p=<?php echo $log; ?>" class="nav-login"><?php echo $log ?></a>
        </div>
    </nav>