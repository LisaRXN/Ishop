// ------------------------------------------------------------------
// ------------------------- Dropdown ------------------------------
// ------------------------------------------------------------------

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

// Filter bar mobile
// function sub_dropdown_filter_mobile() {
//   const subFilterBtn = document.querySelectorAll(".sub-filter-btn");
//   const dropdown = document.querySelectorAll(".dropdown-content-sub");

//   subFilterBtn.forEach((element) => {
//     element.addEventListener("mouseover", () => {
//       parent = element.parentElement;
//       child = element.nextElementSibling.firstElementChild;
//       child.classList.add("active");
//       element.style.fontWeight = "bold";

//       dropdown.forEach((dropdown) => {
//         if (dropdown != child) {
//           dropdown.classList.remove("active");
//         }
//       });
//       subFilterBtn.forEach((btn) => {
//         if (btn != element) {
//           btn.style.fontWeight = "normal";
//         }
//       });

//       parent.addEventListener("mouseleave", () => {
//         child.classList.remove("active");
//       });
//     });
//   });
// }


function sub_dropdown_filter_mobile() {
  const subFilterBtn = document.querySelectorAll(".sub-filter-btn");
  const dropdown = document.querySelectorAll(".dropdown-content-sub");

  subFilterBtn.forEach((element) => {

    element.addEventListener("click", (e) => {
      e.preventDefault();
      console.log('TEST')
      parent = element.parentElement;
      child = element.nextElementSibling.firstElementChild;
      child.classList.toggle("active");
      element.style.fontWeight = "bold";

      // dropdown.forEach((dropdown) => {
      //   if (dropdown != child) {
      //     dropdown.classList.remove("active");
      //   }
      // });

      // subFilterBtn.forEach((btn) => {
      //   if (btn != element) {
      //     btn.style.fontWeight = "normal";
      //   }
      // });

      // parent.addEventListener("click", () => {
      //   child.classList.remove("active");
      // });
    });
  });
}


function dropdown_menu_mobile() {
  const cartBtn = document.querySelector(".navbar-login-button");
  const navLinks = document.querySelector(".nav-modal");
  cartBtn.addEventListener("click", (e) => {
    e.preventDefault();
    console.log("click");
    navLinks.classList.toggle("active");
  });
}

// ------------------------------------------------------------------
// ---------------------- Slide Range Values ------------------------
// ------------------------------------------------------------------

function range_slide_min() {
  slider = document.querySelector("#myRange");
  output = document.querySelector(".filter-range-min");
  output.innerHTML = "$".concat(" ", slider.value);
  slider.addEventListener("input", () => {
    output.innerHTML = "$".concat(" ", slider.value);
  });
}

function range_slide_max() {
  slider2 = document.querySelector("#myRangeRevert");
  output2 = document.querySelector(".filter-range-max");
  output2.innerHTML = "$".concat(" ", slider2.value);
  slider2.addEventListener("input", () => {
    output2.innerHTML = "$".concat(" ", slider2.value);
  });
}

// ------------------------------------------------------------------
// ------------------------- Search bar -----------------------------
// ------------------------------------------------------------------

function search() {
  const searchBar = document.querySelector(".search-bar");
  const searchForm = document.querySelector("#search-form");

  searchForm.addEventListener("keypress", (e) => {
    if (e.keyCode == 13) {
      e.preventDefault();
      searchForm.submit();
    }
  });
}

// ------------------------------------------------------------------
// ------------------------- Slide bar -----------------------------
// ------------------------------------------------------------------

const myRange = document.querySelector("#myRange");
const myRangeRevert = document.querySelector("#myRangeRevert");
const rangeForm = document.querySelector("#range-form");

myRange.addEventListener("change", (e) => {
  e.preventDefault();
  rangeForm.submit();
});

myRangeRevert.addEventListener("change", (e) => {
  e.preventDefault();
  rangeForm.submit();
});

// ------------------------------------------------------------------
// ------------------------- Cart Modal -----------------------------
// ------------------------------------------------------------------

// document.addEventListener("DOMContentLoaded", (event) => {

  // const card_btn = document.querySelectorAll(".card-btn");
  // const modal_close = document.querySelector(".cart-modal-close");
  // const cart_modal = document.querySelector(".cart-modal");
  // const cookie_name_p = document.querySelector('#cookie_name');
  // const cookie_value_p = document.querySelector('#cookie_value');


  // card_btn.forEach((card) => {
  //   card.addEventListener("click", (e) => {
  //     e.preventDefault();
  //     const id = parseInt(card.nextElementSibling.innerHTML);
  
  //     //recupérer le nom du cookie qui correspond à l'id
  //     cookies = document.cookie.split(";").sort();
  
  //     const find_cookie = cookies.filter((e) => {
  //       return parseInt(e.split("=")[0]) === id;
  //     });
  
  //     let cookie_value;
  
  //     if (find_cookie.length != 0) {
  //       cookie_name = find_cookie[0].split("=")[0];
  //       cookie_value = parseInt(find_cookie[0].split("=")[1]) + 1;
  //       // document.cookie = `${id} = ${cookie_value} `;
  //     } else {
  //       cookie_value = 1;
  //       // document.cookie = `${id} = ${cookie_value } `;
  //     }
  
  //     cookie_name_p.innerHTML= cookie_name 
  //     cookie_value_p.innerHTML= cookie_value 
  
  //     // Envoyer la nouvelle valeur au serveur via AJAX
  //     fetch("index.php", {
  //       method: "POST",
  //       headers: {
  //         "Content-Type": "application/x-www-form-urlencoded",
  //       },
  //       body: `cookie_name=${encodeURIComponent(
  //         id
  //       )}&cookie_value=${encodeURIComponent(cookie_value)}`,
  //     })
  //       .then((response) => response.text())
  //       .then((data) => {
  //         console.log("Réponse du serveur :", data);
  //       })
  //       .catch((error) => {
  //         console.error(
  //           "Erreur lors de l'envoi de la nouvelle valeur de cookie :",
  //           error
  //         );
  //       });
  
  
  //     cart_modal.style.display = "block";
  //   });
  //   // if (cart_modal.classList.contains("block")) {
  //   //   e.stopPropagation();
  //   //   e.preventDefault()
  //   // }
  // });
  
  // modal_close.addEventListener("click", () => {
  //   cart_modal.style = "display:none";
  // });




// ------------------------------------------------------------------
// ------------------------- Cart Modal -----------------------------
// ------------------------------------------------------------------

// document.addEventListener("DOMContentLoaded", (event) => {


  const card_btn = document.querySelectorAll(".card-btn");
  const modal_close = document.querySelector(".cart-modal-close");
  const cart_modal = document.querySelector(".cart-modal");

  card_btn.forEach((card) => {
    card.addEventListener("click", (e) => {
      e.preventDefault();
      cart_modal.style.transform = "translateX(0)";
    });

  });
  
  modal_close.addEventListener("click", () => {
    cart_modal.style.transform = "translateX(100%)";
  });














dropdown_filter();
range_slide_min();
range_slide_max();
dropdown_menu_mobile();
search();
// range()
sub_dropdown_filter_mobile();
