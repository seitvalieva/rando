// ================ BURGER MENU =============================//
const handleMobileMenu = () => {
  const navBurgerMenu = document.getElementById("navBurgerMenu");
  const mobileMenu = document.getElementById("mobileMenu");
  const mobileMenuClose = document.getElementById("mobileMenuClose");

  const openMenu = () => {
    mobileMenu.classList.add("mobile-menu--open");
  };
  const closeMenu = () => {
    mobileMenu.classList.remove("mobile-menu--open");
  };

  navBurgerMenu.addEventListener("click", openMenu);
  mobileMenuClose.addEventListener("click", closeMenu);
};

handleMobileMenu();

// ================ SLIDESHOW =============================//
let slideIndex = 1;
showSlides(slideIndex);

// // Next/previous controls
function changeSlide(n) {
  showSlides((slideIndex += n));
}

function showSlides(n) {
  let slides = document.getElementsByClassName("slide");
  if (slides.length === 0) return;
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}

  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
}


