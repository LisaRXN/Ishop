<?php

$products_table = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);

    $products_table->add($name, );
    header('Location: index.php?p=categories');
    exit();
}

require 'header.admin.php';

?>

<div class="edit">

    <h1>Add Category</h1>
    <div class="edit-form">
        <form action="" method="post">

            <label for="name">Name</label>
            <input class="edit-input" type="text" name="name" required>

            <button type="submit" class="product-btn edit-btn">Confirm add</button>

        </form>
    </div>

</div>

<table class="admin"></table>


<script type="module" src='/JS/add_category.js'></script>
