<script> 
// Fonction pour récupérer les cookies sous forme d'objet
function getCookies() {
  const cookies = document.cookie.split(";").reduce((acc, cookie) => {
    const [name, value] = cookie.split("=");
    acc[name.trim()] = parseInt(value);
    return acc;
  }, {});
  return cookies;
}

// Sélection des boutons "Ajouter au panier"
const cardBtns = document.querySelectorAll(".card-btn");
console.log(cardBtns)

cardBtns.forEach((cardBtn) => {
  cardBtn.addEventListener("click", (e) => {
    e.preventDefault();
    const id = parseInt(cardBtn.nextElementSibling.innerHTML);

    // Récupération des cookies
    const cookies = getCookies();
    console.log(cookies)

    let cookieValue = cookies[id] ? cookies[id] + 1 : 1;

    // Envoi de la nouvelle valeur de cookie au serveur via AJAX
    fetch("index.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `cookie_name=${encodeURIComponent(id)}&cookie_value=${encodeURIComponent(cookieValue)}`
    })
    .then((response) => response.text())
    .then((data) => {
      console.log("Réponse du serveur :", data);
      displayModal();
    })
    .catch((error) => {
      console.error("Erreur lors de l'envoi de la nouvelle valeur de cookie :", error);
    });
  });
});

// Fonction pour afficher le modal
function displayModal() {
  const cartModal = document.querySelector(".cart-modal");
  cartModal.style.display = "block";

  const modalClose = document.querySelector(".cart-modal-close");
  modalClose.addEventListener("click", () => {
    cartModal.style.display = "none";
  });
}
</script>

<div class="cart-modal">
  <div class="cart-modal-body">
    <span class="cart-modal-close">x</span>
    <h1 class="cart-modal-title">Added to Cart</h1>

    <?php foreach ($cookies as $cookie_name => $cookie_value): ?>
        <?php $product = $products_table->getById($cookie_name); ?>
        <?php if ($product && $cookie_value != 0): ?>
            <div class="cart-grid-product">
                <div class="cart-product-description-container">
                    <img src="<?php echo $product->image ?>">
                    <div class="cart-product-description">
                        <p class="cart-product-name"><?php echo $product->name ?></p>
                        <p>Art. n°<?php echo $product->id ?></p>
                        <p>Color: <?php echo $product->color ?></p>
                        <p>Quantity: <?php echo $cookie_value ?></p>
                        <p>$ <?php echo $cookie_value * $product->price; ?></p>
                    </div>
                </div>
            </div>
            <?php $total += $cookie_value * $product->price; ?>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ($total == 0): ?>
        <div class="cart-empty">
            <h3>Your shopping bag is empty!</h3>
            <p>Log in to save or access items already in your shopping bag.</p>
        </div>
    <?php endif; ?>
  </div>

  <div class="modal-checkout">
    <div class="cart-total">
        <p>Total: </p><span>$ <p id="checkout-total"><?php echo $total ?></p></span>
    </div>
    <a href="index.php?p=cart" class="login-btn checkout-btn modal-btn">View Cart</a>
  </div>
</div>
