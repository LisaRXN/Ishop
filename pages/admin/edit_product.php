<?php

$products_table = new Product();
$product = $products_table->getById($_GET['id']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $id = trim($_POST['id']);
    $price = trim($_POST['price']);
    $collection = trim($_POST['collection']);
    $category_id = trim($_POST['category_id']);
    $hasError = false;
    $error_message = "";

    //vérifie le nom
    if (empty($name)) {
        $hasError = true;
        $error_message .= "Invalid name.\n";
    }
    //vérifie la category_id
    if (empty($collection)) {
        $hasError = true;
        $error_message .= "Invalid collection.\n";
    }
    //vérifie le category_id
    if (empty($category_id)) {
        $hasError = true;
        $error_message .= "Invalid category_id.\n";
    }
    //vérifie le prix
    if (!is_numeric($price) || $price <= 0) {
        $hasError = true;
        $error_message .= "Invalid price.\n";
    }
    if ($hasError == false) {
        $error_message = "";
        $product->update($name, $category_id, $collection, $price, $id );
        header('Location: index.php?p=products');
        exit();
    }
}

require 'header.admin.php';

?>

<div class="edit">

    <h1>Edit Product</h1>
    
    <div class="error-message"><?php echo $error_message ?></div>

    <div class="edit-form">
    <form action="" method="post">
            <label for="id">Id</label>
            <input class="edit-input" type="text" name="id" value="<?php echo htmlspecialchars($product->id); ?>" readonly="readonly">

            <label for="name">Name</label>
            <input class="edit-input" type="text" name="name" value="<?php echo htmlspecialchars(str_replace("-", " ", $product->name)); ?>">

            <label for="price">Price</label>
            <input class="edit-input" type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($product->price); ?>">

            <label for="collection">Collection</label>
            <input class="edit-input" type="text" name="collection" value="<?php echo htmlspecialchars($product->collection); ?>">

            <label for="category_id">Category</label>
            <input class="edit-input" type="text" name="category_id" value="<?php echo htmlspecialchars($product->category_id); ?>">

            <button type="submit" class="product-btn edit-btn">Confirm edit</button>
        </form>
    </div>

</div>

<table class="admin"></table>



<script type="module" src='/JS/edit_product.js'></script>