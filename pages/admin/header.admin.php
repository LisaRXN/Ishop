<?php
session_start();
$log = "login";
$avatar = "/img/icons/icon-profile.png";

if($_SESSION){
  $users_table = new User();
  $user = $users_table->getByEmail($_SESSION['email']);
  $username = ucfirst($user->username);
  $log = 'logout';
  $welcome ="Welcome $username";

  if($user->avatar != null){
    $avatar = $user->avatar;
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


      <!-- Navigation -->
      <nav id="navigation">
        <div class="nav-content-left">
          <a href="/index.php?p=home" class="nav-content-logo" ><img class="navbar-logo" src="/img/Logo.png"/></a>
          
          
                  <!-- Navigation MOBILE -->
        <div class="nav-links nav-modal">

<?php if ($_SESSION['admin'] == 1): ?>
  <div class="nav-modal-link"><a href="/index.php?p=admin" class="nav-link nav-link-admin ">ADMIN</a>
    <p>></p>
  </div>
<?php endif ?>

  <div class="nav-modal-link <?= $_GET['p'] == "products" ? 'link-hidden' : 'link-active' ?> ">
    <a href="/index.php?p=products" class="nav-link">PRODUCT</a>
    <p>></p>
  </div>
  <div class="nav-modal-link <?= $_GET['p'] == "categories" ? 'link-hidden' : 'link-active' ?>">
    <a href="/index.php?p=categories" class="nav-link">CATEGORIES</a>
    <p>></p>
  </div>
  <div class="nav-modal-link <?= $_GET['p'] == "users" ? 'link-hidden' : 'link-active' ?>"><a
      href="/index.php?p=users" class="nav-link">USERS</a>
    <p>></p>
  </div>

  <div class="nav-modal-link <?= $_GET['p'] == $log ? 'link-hidden' : 'link-active' ?>"><a
      href="/index.php?p=<?php echo $log ?>" class="nav-link nav-link-mobile"><?php echo $log ?></a>
    <p>></p>
  </div>
</div>

<!-- END Navigation MOBILE -->
          
          
          <div class="nav-links">
          <a href="/index.php?p=admin" class="nav-link" style="color:blue">ADMIN</a>
            <a href="/index.php?p=products" class="nav-link">PRODUCTS</a>
            <a href="/index.php?p=categories" class="nav-link">CATEGORIES</a>
            <a href="/index.php?p=users" class="nav-link">USERS</a>
          </div>
    
        </div>
        <div class="nav-content-right">
          <p class="nav-welcome"><?php echo $welcome ;?></p>
          <div class="navbar-avatar-container"><a href="index.php/?p=my_account" > <img class="navbar-avatar-button" src="<?= $avatar ?>" /></a></div>
          <a href="" class=""> <img class="navbar-cart-button" src="/img/Cart_Button.png" /></a>
          <img class="navbar-login-button" src="/img/login-logo.png" />
          <a href="/index.php?p=<?php echo $log; ?>" class="nav-login"><?php echo $log ?></a>
        </div>
      </nav>