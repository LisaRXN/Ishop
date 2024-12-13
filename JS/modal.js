// ------------------------------------------------------------------
// ------------------------- Cart Modal -----------------------------
// ------------------------------------------------------------------

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
    let cookie_name = id
    console.log(find_cookie.length)

    if (find_cookie.length != 0) {
      cookie_value = parseInt(find_cookie[0].split("=")[1]) + 1;
      // document.cookie = `${id} = ${cookie_value} `;
      quantity_div.innerHTML=cookie_value;

    } else {
      cookie_value = 1;
      document.cookie = `${id} = ${cookie_value } `;
      quantity_div.innerHTML=cookie_value;
    }

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


    cart_modal.style.display = "block";
  });

});

modal_close.addEventListener("click", () => {
  cart_modal.style = "display:none";
});
