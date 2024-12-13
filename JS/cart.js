// ------------------------------------------------------------------
// ---------------------- Menu dropdown mobile ----------------------
// ------------------------------------------------------------------
function dropdown_menu_mobile() {
  const cartBtn = document.querySelector(".navbar-login-button");
  const navLinks = document.querySelector(".nav-modal");
  cartBtn.addEventListener("click", (e) => {
    e.preventDefault();
    console.log("click");
    navLinks.classList.toggle("active");
  });
}

dropdown_menu_mobile()

// ------------------------------------------------------------------
// -------------------- Calcul Total & Checkout ---------------------
// ------------------------------------------------------------------
const removeLink = document.querySelectorAll(".cart-grid-quantity-link");
const cartEmpty = document.querySelector(".cart-empty");
const cartGrid = document.querySelector(".cart-grid");

removeLink.forEach((remove) => {
  remove.addEventListener("click", () => {
    const div_quantity = remove.parentElement;
    quantity = div_quantity.firstElementChild.childNodes[3].innerHTML;

    console.log(quantity);

    const div_total = div_quantity.nextElementSibling;
    const div_product = div_quantity.previousElementSibling;
    const div_id = div_total.childNodes[3];
    const id = parseInt(div_id.innerHTML);

    if (chekout > 0) {
      chekout -= parseInt($products[id - 1].price) * quantity;
      div_checkout.innerHTML = chekout;

      div_quantity.style.display = "none";
      div_total.style.display = "none";
      div_product.style.display = "none";

      // document.cookie = `${id} = ${0} ;
      document.cookie = `${id} =; expires=Thu, 01 Jan 1970 00:00:00 UTC;`;

    }

    if (chekout >= 0) {
      location.reload();
    }
  });
});



