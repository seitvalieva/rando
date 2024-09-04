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
// let slideIndex = 1;
// showSlides(slideIndex);

// // Next/previous controls
// function plusSlides(n) {
//   showSlides((slideIndex += n));
// }
// // Thumbnail image controls
// function currentSlide(n) {
//   showSlides((slideIndex = n));
// }
// function showSlides(n) {
//   let i;
//   let slides = document.getElementsByClassName("mySlides");
//   let dots = document.getElementsByClassName("dot");
//   if (n > slides.length) {slideIndex = 1}
//   if (n < 1) {slideIndex = slides.length}
//   for (i = 0; i < slides.length; i++) {
//     slides[i].style.display = "none";
//   }
//   for (i = 0; i < dots.length; i++) {
//     dots[i].className = dots[i].className.replace(" active", "");
//   }
//   slides[slideIndex-1].style.display = "block";
//   dots[slideIndex-1].className += " active";
// }

// COOKIES
// console.log("test");
const cookieBox = document.querySelector(".cookieBox"),
buttons = document.querySelectorAll(".cookie-btn");

const executeCodes = () => {
  //if cookie contains rando it will be returned and below of this code will not run
  if (document.cookie.includes("rando")) return;
  cookieBox.classList.add("show");

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      // console.log("test");
      cookieBox.classList.remove("show");

      //if button has acceptBtn id
      if (button.id == "acceptBtn") {
        //set cookies for 1 month. 60 = 1 min, 60 = 1 hours, 24 = 1 day, 180 = 180 days
        document.cookie = "cookieBy= rando; max-age=" + 60 * 60 * 24 * 180;
      }
    });
  });
};
//executeCodes function will be called on webpage load
window.addEventListener("load", executeCodes);

// 