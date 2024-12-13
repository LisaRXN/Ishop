<?php

require 'header.admin.php';

// Recupere tous les articles
$products_table = new Category();
$products = $products_table->getAll();

// Pagination du footer
$id = $_GET['page_id'] ? $_GET['page_id'] : 1;
$limit = 7;
$start = ($id - 1) * $limit;
$count = $products_table->count();
$pages = ceil($count / $limit);

// Suppression d'un article 
if (isset( $_GET['delete_category'] )){
    $products_table->delete($_GET['id']);
}
?>


<div class="products">

<h1>Categories</h1>

<div class="products-container">

<button class="products-grid-btn products-grid-add"><a class="products-grid-edit products-grid-add" href="index.php?p=add_category">Add New</a></button>

<div class="products-grid products-grid-title products-grid cateogories-grid">
    <p>Name</p>
    <p>ID</p>
    <p>Actions</p>
</div>

<?php foreach (array_slice($products, $start, $limit) as $product): ?>
    <div class="products-grid cateogories-grid">
    <div class="products-grid-row products-grid-left"> <?= str_replace("-", " ", $product->name); ?> </div>
    <div class="products-grid-row products-grid-center"> <?= $product->id ?> </div>
    <div class="products-grid-btn products-grid-row products-grid-center"> 
    <button class="products-grid-edit"><a href="index.php?p=edit_category&id=<?php echo $product->id ?>" >Edit</a></button>
    <button class="products-grid-delete"><a href="index.php?p=categories&delete_category&id=<?php echo $product->id ?>" >Delete</a></button>

    </div>
</div>
<?php endforeach ?>

</div>


    <!-------------- Footer ------------->
    <?php require 'templates/footer.php' ?>


<script type="module" src='/JS/categories.js'></script>

