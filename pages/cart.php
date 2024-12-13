<?php
require 'templates/header.php';

$products_table = new Product();
$products = $products_table->getAll();
$test = "TEST";

?>

<div class="cart">

    <div class="cart-title">
        <h1>cart</h1>
    </div>

    <div class="cart-body">

        <?php
        $cookies = $_COOKIE;
        ksort($cookies);
        $total = 0;
        ?>

        <div class="cart-grid">
            <div class="cart-grid-row1">product</div>
            <div class="cart-grid-row1">quantity</div>
            <div class="cart-grid-row1">total</div>
            
            <?php foreach ($cookies as $cookie_name => $cookie_value): ?>
                <?php $product = $products_table->getById($cookie_name); ?>
                <?php if ($product && $cookie_value != 0): ?>
                    <?php $total += $cookie_value * $product->price ?>


                    <div class="cart-grid-product">
                        <div class="cart-product-description-container">
                            <a href="/index.php?p=product&id=<?= $product->id ?>"><img  src="<?php echo $product->image ?>"></a>
                            <div class="cart-product-description">
                                <a href="/index.php?p=product&id=<?= $product->id ?>" class="cart-product-name"><?php echo $product->name ?> </a>
                                <p>Art. n°<?php echo $product->id ?></p>
                                <p>Color: <?php echo $product->color ?> </p>
                                <p>Price: $ <?php echo $product->price ?> </p>
                            </div>
                        </div>
                    </div>


                    <div class="cart-grid-quantity">
                        <div class="cart-grid-quantity-counter">
                            <button class="quantity-button cart-decrement">-</button>
                            <div class="quantity-counter" id="cart-count"> <?php echo $cookie_value ?> </div>
                            <button class="quantity-button cart-increment">+</button>
                        </div>
                        <a class="cart-grid-quantity-link">Remove</a>
                    </div>
                    <div class="cart-grid-total">
                        <p class="cart-grid-total-p">$ <?php echo $cookie_value * $product->price; ?> </p>
                        <p id="product-id"><?php echo $product->id ?></p>
                    </div>
                <?php endif ?>
            <?php endforeach ?>

            <?php if ($total == 0): ?>
                <div class="cart-empty">
                    <h3>Your shopping bag is empty!</h3>
                    <p>Log in to save or access items already in your shopping bag.</p>
                </div>

            <?php endif ?>

        </div>

        <div class="cart-checkout">
            <div class="cart-total">
                <p>Total: </p><span>$ <p id="checkout-total"><?php echo $total ?></p></span>
            </div>
            <button type="submit" class="login-btn checkout-btn"><a href="index.php?p=checkout">Checkout</a></button>
            <button class="login-btn"><a href="/index.php?p=login">Log In</a></button>
        </div>

    </div>





</div>


<!------------- JS -------------->
<script>

    // Recupere les données de la database en json
    const $products = <?php echo json_encode($products); ?>;
    const div_checkout = document.querySelector('#checkout-total')
    let chekout = parseInt(div_checkout.innerHTML)

    // Fonction decrementer
    document.querySelectorAll('.cart-decrement').forEach(btn => {
        btn.addEventListener('click', () => {

            const div_quantity = btn.parentElement.parentElement;
            const div_total = div_quantity.nextElementSibling;
            const div_id = div_total.childNodes[3];

            const quantityDiv = btn.nextElementSibling;
            const id = parseInt(div_id.innerHTML);

            let total = parseInt(div_total.firstElementChild.innerHTML)
            let quantity = parseInt(quantityDiv.innerHTML);

            if (quantity > 1) {
                quantity -= 1;
                total = quantity * parseInt($products[id - 1].price)
                chekout -= parseInt($products[id - 1].price)
                quantityDiv.innerHTML = quantity;
                div_total.firstElementChild.innerHTML = '$ ' + total
                div_checkout.innerHTML = chekout

                document.cookie = `${id}=${quantity}`;

            }
        })
    })

    // Fonction incrementer
    document.querySelectorAll('.cart-increment').forEach(btn => {
        btn.addEventListener('click', () => {

            const div_quantity = btn.parentElement.parentElement;
            const div_total = div_quantity.nextElementSibling;
            const quantityDiv = btn.previousElementSibling;
            const div_id = div_total.childNodes[3];
            const id = div_id.innerHTML;

            let total = parseInt(div_total.firstElementChild.innerHTML)
            let quantity = parseInt(quantityDiv.innerHTML);

            if (quantity > 0) {
                quantity += 1;
                total = quantity * parseInt($products[id - 1].price)
                chekout += parseInt($products[id - 1].price)
                quantityDiv.innerHTML = quantity;
                div_total.firstElementChild.innerHTML = '$ ' + total
                div_checkout.innerHTML = chekout

                document.cookie = `${id}=${quantity}`;

            }

        })
    })


</script>
<script src='/JS/cart.js'>

</script>

</body>

</html>