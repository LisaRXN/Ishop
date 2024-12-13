<?php

require 'header.admin.php';

// Recupere tous les articles
$products_table = new Product();
$products = $products_table->getAll();

// Pagination du footer
$id = $_GET['page_id'] ? $_GET['page_id'] : 1;
$limit = 7;
$start = ($id - 1) * $limit;
$count = $products_table->count();
$pages = ceil($count / $limit);

// Suppression d'un article 
if (isset($_GET['delete_product'])) {
    $products_table->delete($_GET['id']);
}
?>

<div class="products">


    <h1>Products</h1>

    <div class="products-container">

        <button class="products-grid-btn products-grid-add"><a  href="index.php?p=add_product">Add New</a></button>

        <div class="products-grid products-grid-title">
            <p class="products-grid-left">Product</p>
            <p>ID</p>
            <p>Category</p>
            <p class="products-grid-center">Actions</p>
        </div>

        <?php foreach (array_slice($products, $start, $limit) as $product): ?>

            <div class="products-grid">
                <div class="products-grid-left"> <?php echo str_replace("-", " ", $product->name); ?> </div>
                <div class="products-grid-center"> <?php echo str_replace("-", " ", $product->id); ?> </div>
                <div class="products-grid-center"> <?php echo str_replace("-", " ", $product->category_id); ?></div>
                <div class="products-grid-btn products-grid-center">
                    <button class="products-grid-edit"><a  href="index.php?p=edit_product&id=<?php echo $product->id ?>">Edit</a></button>
                    <button class="products-grid-delete"><a 
                        href="index.php?p=products&delete_product&id=<?php echo $product->id ?>">Delete</a></button>
                </div>
            </div>
        <?php endforeach ?>

    </div>

    <!-------------- Footer ------------->
    <?php require 'templates/footer.php' ?>


    <script type="module" src='/JS/products.js'></script>