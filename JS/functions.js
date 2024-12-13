export function dropdown_menu_mobile() {
  const cartBtn = document.querySelector(".navbar-login-button");
  const navLinks = document.querySelector(".nav-modal");
  cartBtn.addEventListener("click", (e) => {
    e.preventDefault();
    console.log("click");
    navLinks.classList.toggle("active");
  });
}