<?php

$products_table = new Category();
$product = $products_table->getById($_GET['id']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $id = trim($_POST['id']);
    $hasError = false;
    $error_message = "";

    if ($name==null) {
        $hasError = true;
        $error_message .= "Invalid name.\n";
    }

    if ($hasError == false) {
        $error_message = "";
        $product->update($name, $id);
        header('Location: index.php?p=categories');
        exit();
    }
}

require 'header.admin.php';

?>

<div class="edit">

    <h1>Edit Category</h1>
    
    <div class="error-message"><?php echo $error_message ?></div>

    <div class="edit-form">
        <form action="" method="post">

            <label for="id">Id</label>
            <input class="edit-input" type="text" name="id" value="<?php echo $product->id; ?>" readOnly="readOnly" >

            <label for="id">Name</label>
            <input class="edit-input" type="text" name="name"
                value="<?php echo str_replace("-", " ", $product->name); ?>" required>

            <button type="submit" class="product-btn edit-btn">Confirm edit</button>

        </form>
    </div>

</div>

<table class="admin"></table>



<script type="module" src='/JS/edit_category.js'></script>