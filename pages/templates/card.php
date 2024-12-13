<?php
$products_table = new Product();

// Nombre d'articles par page 
$id = $_GET['page_id'] ? $_GET['page_id'] : 1;
if ($_GET['page_id']) {
    $id = $_GET['page_id'];
} else {
    $id = 1;
}
$start = ($id - 1) * $limit;

?>

<!-- Number of results -->
<?php foreach (array_slice($products, $start, $limit) as $product): ?>

    <!-- Product Card -->
    <div id="card">
        <header class="card-img">
            <a href="index.php?p=product&id=<?= $product->id ?>"><img src="<?= $product->image ?>" /></a>
        </header>

        <div class="card-body">
            <a href="index.php?p=product&id=<?= $product->id ?>" class="card-title"> <?= $product->name ?> </a>
            <p class="card-price">$<?= $product->price ?></p>
        </div>

        <footer class="card-footer">
            <div class="card-subtitle">
                <p><?= str_replace("-", " ", $product->category_name) ?></p>
                <img class="card-icon-stars" src="/img/Star - On.png" />
                <img class="card-icon-stars" src="/img/Star - On.png" />
                <img class="card-icon-stars" src="/img/Star - On.png" />
                <img class="card-icon-stars" src="/img/Star - On.png" />
                <img class="card-icon-stars" src="/img/Star.png" />
            </div>
            <div class="card-icon-shop">
                <!-- <form action="" method="post"> -->
                    <a href="index.php?p=home&add_id=<?= $product->id ?>" class="card-btn" ><img src="/img/Cart_Button.png" /></a>
                    <p style="display:none"><?= $product->id ?></p>
                <!-- </form> -->

            </div>
        </footer>
    </div>
<?php endforeach ?>