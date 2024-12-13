<?php

$products_table = new Product();
$product = $products_table->getById($_GET['id']);


if (isset($_POST['add_to_cart'])) {

    if (isset( $_COOKIE[$product->id] )){
        setcookie(
            $product->id,
            $_COOKIE[$product->id] + $_POST['quantity'],
            time() + 60 * 60 * 24 * 30
        );

    }else{
        setcookie(
            $product->id,
            $_POST['quantity'],
            time() + 60 * 60 * 24 * 30
        );
    }

}

require 'templates/header.php';




?>


<div class="product">

    <div class="product-card">

        <header class="product-img">
            <img src="<?= $product->image ?>" />
        </header>

        <div class="product-body">
            <h1 class="product-name"> <?= $product->name ?> </h1>
            <p class="product-price">$<?= $product->price ?></p>
            <p class="product-collection"><b>Collection: </b><?= str_replace("-", " ", $product->collection) ?>
            </p>
            <p class="product-color"><b>Color: </b><?= $product->color ?></p>
            <p class="product-description"><b>Description: </b> <?= $product->description ?></p>

            <div class="product-add">
            <form action="" method="post">
                <select class="product-quantity" id="quantity" name="quantity">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                    <button class="product-btn" name="add_to_cart">Add to cart</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="module" src="/JS/product.js"></script>

</body>

</html>
