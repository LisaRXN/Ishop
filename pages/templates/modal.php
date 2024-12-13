<?php

$products_table = new Product();
$products = $products_table->getAll();

$cookies = $_COOKIE;
ksort($cookies);
$total = 0;
?>

<div class="cart-modal">

    <div class="cart-modal-body">
        <span class="cart-modal-close">x</span>

        <div>
            <h1 class="cart-modal-title">Added to Cart</h1>
            <p id="cookie_name"></p>
            <p id="cookie_value"></p>   
        </div>
        <?php 
        
        
        ?>


        <?php foreach ($cookies as $cookie_name => $cookie_value): ?>
            <?php $product = $products_table->getById($cookie_name); ?>
            <?php if ($product): ?>
                <?php $total += $cookie_value * $product->price ?>

                <div class="cart-grid-product">
                    <div class="cart-product-description-container">
                        <img src="<?php echo $product->image ?>">
                        <div class="cart-product-description">
                            <p class="cart-product-name"><?php echo $product->name ?> </p>
                            <p>Art. n°<?php echo $product->id ?></p>
                            <p>Color: <?php echo $product->color ?> </p>
                            <p>Quantity: <?= $cookie_value ?></p>
                            <p>$ <?php echo $cookie_value * $product->price; ?> </p>
                        </div>
                    </div>
                </div>

                <!-- display none -->
                <div class="cart-grid-quantity" style="display:none">
                    <div class="cart-grid-quantity-counter">
                        <button class="quantity-button cart-decrement">-</button>
                        <div class="quantity-counter" id="cart-count"> <?php echo $cookie_value ?> </div>
                        <button class="quantity-button cart-increment">+</button>
                    </div>
                    <a class="cart-grid-quantity-link">Remove</a>
                </div>
                <div class="cart-grid-total" style="display:none">
                    <p class="cart-grid-total-p">$ <?php echo $cookie_value * $product->price; ?> </p>
                    <p id="product-id"><?php echo $product->id ?></p>
                </div>
                <!----------------->

            <?php endif ?>
        <?php endforeach ?>

        <?php if ($total == 0): ?>
            <div class="cart-empty">
                <h3>Your shopping bag is empty!</h3>
                <p>Log in to save or access items already in your shopping bag.</p>
            </div>
        <?php endif ?>

    </div>

    <div class="modal-checkout">
        <div class="cart-total">
            <p>Total: </p><span>$ <p id="checkout-total"><?php echo $total ?></p></span>
        </div>
        <a href="index.php?p=cart" class="login-btn checkout-btn modal-btn">View Cart</a>
    </div>

</div>

</div>




<!-- <script>

// ------------------------------------------------------------------
// ------------------------- Cart Modal -----------------------------
// ------------------------------------------------------------------

const $products = <?php echo json_encode($products); ?>;


const card_btn = document.querySelectorAll(".card-btn");
  const modal_close = document.querySelector(".cart-modal-close");
  const cart_modal = document.querySelector(".cart-modal");
  const cookie_name_p = document.querySelector("#cookie_name");
  const cookie_value_p = document.querySelector("#cookie_value");
  const quantity_div = document.querySelector('#quantity');


  card_btn.forEach((card) => {
    card.addEventListener("click", (e) => {
      e.preventDefault();
      const id = parseInt(card.nextElementSibling.innerHTML);
  
      //recupérer le nom du cookie qui correspond à l'id
      cookies = document.cookie.split(";").sort();
  
      const find_cookie = cookies.filter((e) => {
        return parseInt(e.split("=")[0]) === id;
      });
  
      let cookie_value;
      let cookie_name = find_cookie[0].split("=")[0];
  
      if (find_cookie.length != 0) {
    
        cookie_value = parseInt(find_cookie[0].split("=")[1]) + 1;
        // document.cookie = `${id} = ${cookie_value} `;
      } else {
        cookie_value = 1;
        // document.cookie = `${id} = ${cookie_value } `;
      }
      cookie_name_p.innerHTML= cookie_name 
      cookie_value_p.innerHTML= cookie_value 

      // Envoyer la nouvelle valeur au serveur via AJAX
      fetch("index.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `cookie_name=${encodeURIComponent(
          id
        )}&cookie_value=${encodeURIComponent(cookie_value)}`,
      })
        .then((response) => response.text())
        .then((data) => {
          console.log("Réponse du serveur :", data);
        })
        .catch((error) => {
          console.error(
            "Erreur lors de l'envoi de la nouvelle valeur de cookie :",
            error
          );
        });

        quantity_div.innerHTML=cookie_value;
  
  
      cart_modal.style.display = "block";
    });
    // if (cart_modal.classList.contains("block")) {
    //   e.stopPropagation();
    //   e.preventDefault()
    // }
  });
  
  modal_close.addEventListener("click", () => {
    cart_modal.style = "display:none";
  });




</script> -->