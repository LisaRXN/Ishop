<?php

$products_table = new Product();
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category_id = trim($_POST['category_id']);
    $collection = trim($_POST['collection']);
    $price = trim($_POST['price']);
    $hasError = false;
    $error_message = "";


    if (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
        $hasError = true;
        $error_message .= "Invalid price.\n";
    }
    if (!filter_var($category_id, FILTER_VALIDATE_INT)) {
        $hasError = true;
        $error_message .= "Invalid category.\n";
    } 
    
    if($hasError==false) {
        $error_message = "";
        $products_table->add($name, $category_id, $collection, $price);
        header('Location: index.php?p=products');
        exit();
    }
}

require 'header.admin.php';

?>

<div class="edit">

    <h1>Add Product</h1>
    <div class="error-message"><?php echo $error_message ?></div>
    <div class="edit-form">
        <form action="" method="post">

            <label for="name">Name</label>
            <input class="edit-input" type="text" name="name" required>

            <label for="price">Price</label>
            <input class="edit-input" type="text" name="price" required>

            <label for="collection">Collection</label>
            <input class="edit-input" type="text" name="collection">

            <label for="category_id">Category</label>
            <input class="edit-input" type="number" name="category_id" required>

            <button type="submit" class="product-btn edit-btn">Confirm add</button>

        </form>
    </div>
</div>

<table class="admin"></table>



<script type="module" src='/JS/add_product.js'></script>
