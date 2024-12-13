import {dropdown_menu_mobile} from './functions.js';

// ------------------------------------------------------------------
// ---------------------- Menu dropdown mobile ----------------------
// ------------------------------------------------------------------
dropdown_menu_mobile();



// ------------------------------------------------------------------
// ---------------------------- Delete ------------------------------
// ------------------------------------------------------------------
deleteLink = document.querySelectorAll(".delete");
table = document.querySelector(".admin-table");


deleteLink.forEach((element) => {

  element.addEventListener("click", () => {
    deleteBtn = element.parentElement.nextElementSibling;
    deleteBtn.style.display = "block";

  });
  
});
