<?php

// Afficher les produits du panier
$products_table = new Product();
$products = $products_table->getAll();

$cookies = $_COOKIE;
ksort($cookies);
$total = 0;

// Garder les informations de l'utilisateur 
$error_message = "";
$users_table = new User();
$user = $users_table->getByEmail($_SESSION['email']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $username = htmlentities(trim($_POST['username']));
    $firstname = htmlentities(trim($_POST['firstname']));
    $lastname = htmlentities(trim($_POST['lastname']));
    $street = htmlentities(trim($_POST['street']));
    $city = htmlentities(trim($_POST['city']));
    $zipcode = htmlentities(trim($_POST['zipcode']));

    // Requete
    $user->saveInfo($email, $firstname, $lastname, $street, $city, $zipcode);
    header('Location: index.php?p=checkout');
    exit();

}
    require 'templates/header.php';
?>

<div class="cart">

    <div class="cart-title">
        <h1>Checkout</h1>
    </div>


    <div class="checkout-body">

        <div class="checkout-left">

            <h1>Shipping and delivery</h1>

            <div class="error-message"><?php echo $error_message ?></div>

            <div class="edit-form checkout-form">
                <form action="" method="post">

                    <label for="email">Firstname</label>
                    <input class="edit-input" type="text" value="<?= $user->firstname ?>" name="firstname">

                    <label for="email">Lastname</label>
                    <input class="edit-input" type="text" value="<?= $user->lastname ?>" name="lastname">

                    <label for="email">Street Adress</label>
                    <input class="edit-input" type="text" value="<?= $user->street ?>" name="street">

                    <label for="email">City</label>
                    <input class="edit-input" type="text" value="<?= $user->city ?>" name="city">

                    <label for="email">Zip Code</label>
                    <input class="edit-input" type="text" value="<?= $user->zipcode ?>" name="zipcode">

                    <label for="email">Email</label>
                    <input class="edit-input" type="email" name="email" value="<?= $user->email ?>" readOnly="readOnly">

                    <label for="email">Cell Phone</label>
                    <input class="edit-input" type='tel' value="<?= $user->tel ?>" name="tel">

                    <?php if(!empty($_SESSION['username'])) :?> 
                        <button type="submit" name="submit" class="product-btn edit-btn account-btn">Save Info</button>
                    <?php endif ?>
                </form>

            </div>


        </div>


        <div class="filter-container checkout-right">


            <div class="filter-btn-container">
                <button class="filter-btn filter-btn-bold">Cart</button>
                <img class="search-filter-img" src="/img/btn-black.png" />
            </div>
            <div class="dropdown-content filter-dropdown checkout-dropdown">

                <?php foreach ($cookies as $cookie_name => $cookie_value): ?>
                    <?php $product = $products_table->getById($cookie_name); ?>
                    <?php if ($product && $cookie_value != 0): ?>

                        <?php $total += $cookie_value * $product->price ?>

                        <div class="cart-grid-product">
                            <div class="cart-product-description-container">

                                <a href="/index.php?p=product&id=<?= $product->id ?>"><img
                                        src="<?php echo $product->image ?>"></a>
                                <div class="cart-product-description">
                                    <a href="/index.php?p=product&id=<?= $product->id ?>"
                                        class="cart-product-name"><?php echo $product->name ?> </a>
                                    <p>Art. n°<?php echo $product->id ?></p>
                                    <p>Color: <?php echo $product->color ?> </p>
                                    <p>Price: $ <?php echo $product->price ?> </p>
                                    <p>Quantity: <?php echo $cookie_value ?> </p>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>

            </div>



            <div class="checkout-paiement">
                <form action="index.php?p=create-checkout-session" method="POST">
                    <div class="cart-total">
                        <p>Total: </p><span>$ <p id="checkout-total"><?php echo $total ?></p></span>
                    </div>
                    <input type="hidden" name="total" value="<?= $total; ?>">
                    <button type="submit" class="login-btn checkout-btn" id="checkout-button">Pay with Stripe</button>
                </form>
                <button class="login-btn"><a href="/index.php?p=login">Log In</a></button>
            </div>




        </div>




    </div>

</div>








<!------------- JS -------------->
<script src="https://js.stripe.com/v3/"></script>

<script>

    // // Recupere les données de la database en json
    // const $products = <?php echo json_encode($products); ?>;
    // const div_checkout = document.querySelector('#checkout-total')
    // let chekout = parseInt(div_checkout.innerHTML)

    // // Fonction decrementer
    // document.querySelectorAll('.cart-decrement').forEach(btn => {
    //     btn.addEventListener('click', () => {

    //         const div_quantity = btn.parentElement.parentElement;
    //         const div_total = div_quantity.nextElementSibling;
    //         const div_id = div_total.childNodes[3];

    //         const quantityDiv = btn.nextElementSibling;
    //         const id = parseInt(div_id.innerHTML);

    //         let total = parseInt(div_total.firstElementChild.innerHTML)
    //         let quantity = parseInt(quantityDiv.innerHTML);

    //         if (quantity > 1) {
    //             quantity -= 1;
    //             total = quantity * parseInt($products[id - 1].price)
    //             chekout -= parseInt($products[id - 1].price)
    //             quantityDiv.innerHTML = quantity;
    //             div_total.firstElementChild.innerHTML = '$ ' + total
    //             div_checkout.innerHTML = chekout

    //             document.cookie = `${id}=${quantity}`;

    //         }
    //     })
    // })

    // Fonction incrementer
    // document.querySelectorAll('.cart-increment').forEach(btn => {
    //     btn.addEventListener('click', () => {

    //         const div_quantity = btn.parentElement.parentElement;
    //         const div_total = div_quantity.nextElementSibling;
    //         const quantityDiv = btn.previousElementSibling;
    //         const div_id = div_total.childNodes[3];
    //         const id = div_id.innerHTML;

    //         let total = parseInt(div_total.firstElementChild.innerHTML)
    //         let quantity = parseInt(quantityDiv.innerHTML);

    //         if (quantity > 0) {
    //             quantity += 1;
    //             total = quantity * parseInt($products[id - 1].price)
    //             chekout += parseInt($products[id - 1].price)
    //             quantityDiv.innerHTML = quantity;
    //             div_total.firstElementChild.innerHTML = '$ ' + total
    //             div_checkout.innerHTML = chekout

    //             document.cookie = `${id}=${quantity}`;

    //         }

    //     })
    // })

    function dropdown_filter() {
        const filterBtn = document.querySelectorAll(".filter-btn");
        const dropdown = document.querySelectorAll(".filter-dropdown");
        filterBtn.forEach((element) => {
            element.addEventListener("click", () => {
                nextElement = element.nextElementSibling;
                parent = element.parentElement;
                child = parent.nextElementSibling;

                nextElement.classList.toggle("rotate");
                child.classList.toggle("active");

                dropdown.forEach((dropdown) => {
                    if (dropdown != child) {
                        dropdown.classList.remove("active");
                    }

                    filterBtn.forEach((btn) => {
                        if (btn != element) {
                            btn.nextElementSibling.classList.remove("rotate");
                        }
                    });
                });
            });
        });
    }
    dropdown_filter()
</script>
<script src='/JS/checkout.js'>

</script>

</body>

</html>