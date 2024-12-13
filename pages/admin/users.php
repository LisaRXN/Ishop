<?php

require 'header.admin.php';

// Recupere tous les articles
$products_table = new User();
$products = $products_table->getAll();

// Pagination du footer
$id = $_GET['page_id'] ? $_GET['page_id'] : 1;
$limit = 7;
$start = ($id - 1) * $limit;
$count = $products_table->count();
$pages = ceil($count / $limit);

// Suppression d'un article 
if (isset($_GET['delete_user'])) {
    $products_table->delete($_GET['id']);
}

?>

<div class="products">

    <h1>Users</h1>

    <div class="products-container">

    <button class="products-grid-btn products-grid-add"><a class="products-grid-edit products-grid-add" href="index.php?p=add_user">Add New</a></button>


        <div class="products-grid products-grid-title">
            <p class="products-grid-left">Username</p>
            <p class="products-grid-id">ID</p>
            <p class="products-grid-center">Email</p>
            <p>Actions</p>
        </div>

        <?php foreach (array_slice($products, $start, $limit) as $product): ?>
            <div class="products-grid">
                <div ><p class="products-grid-left"><?php echo str_replace("-", " ", $product->username); ?> </p> </div>
                <div ><p class="products-grid-id"> <?php echo str_replace("-", " ", $product->id); ?></p> </div>
                <div > <p class="products-grid-center"> <?php echo str_replace("-", " ", $product->email);?></p></div>
                <div class="products-grid-btn products-grid-right">
                <button class="products-grid-edit"><a href="index.php?p=edit_user&id=<?php echo $product->id ?>">Edit</a></button>
                <button class="products-grid-delete"><a href="index.php?p=users&delete_user&id=<?php echo $product->id ?>">Delete</a></button>

                </div>
            </div>
        <?php endforeach ?>

    </div>


    <!-------------- Footer ------------->
    <?php require 'templates/footer.php' ?>


    <script type="module" src='/JS/users.js'></script>