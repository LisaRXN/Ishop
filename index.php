<?php
require './app/Autoloader.php';
session_start();

$pages = "//pages//";

if ($_SERVER["REQUEST_URI"] == "/auth/google/callback") {
    require './auth/google_callback.php';
}



//---------Redirection des pages----------
if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

if ($p == "home") {
    require './pages/home.php';
} elseif ($p === 'shop') {
    require './pages/shop.php';
} elseif ($p === 'magazine') {
    require './pages/magazine.php';
} elseif ($p === 'product') {
    require './pages/product.php';
} elseif ($p === 'login') {
    require './pages/login.php';
} elseif ($p === 'register') {
    require './pages/register.php';
} elseif ($p === 'cart') {
    require './pages/cart.php';
} elseif ($p === 'logout') {
    session_unset();
    session_destroy();
    require './pages/login.php';
} elseif ($p === 'admin') {
    require './pages/admin.php';
} elseif ($p === 'products') {
    require './pages/admin/products.php';
} elseif ($p === 'edit_product') {
    require './pages/admin/edit_product.php';
} elseif ($p === 'edit_user') {
    require './pages/admin/edit_user.php';
} elseif ($p === 'edit_category') {
    require './pages/admin/edit_category.php';
} elseif ($p === 'users') {
    require './pages/admin/users.php';
} elseif ($p === 'categories') {
    require './pages/admin/categories.php';
} elseif ($p === 'add_product') {
    require './pages/admin/add_product.php';
} elseif ($p === 'add_category') {
    require './pages/admin/add_category.php';
} elseif ($p === 'add_user') {
    require './pages/admin/add_user.php';
} 
elseif ($p === 'google') {
    require './auth/google.php';
} elseif ($p === 'reset_form') {
    require './pages/reset_form.php';
} elseif ($p === 'reset_confirm') {
    require './pages/reset_confirm.php';
} elseif ($p === 'my_account') {
    require './pages/account/my_account.php';
} elseif ($p === 'profile') {
    require './pages/account/profile.php';
} elseif ($p === 'checkout') {
    require './pages/checkout.php';
} elseif ($p === 'create-checkout-session') {
    require './pages/create-checkout-session.php';
}







if (isset($_GET['search'])) {
    require './pages/shop.php';
}
