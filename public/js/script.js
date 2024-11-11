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

// to CLOSE DELETE RANDO CONFIRMATION MODAL
var modal = document.getElementById('deleteRando');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// WEATHER INFO with OpenWeather API

// Get the location for weather from the destination element
const destination = document.getElementById("destination").innerText.split(":").pop().trim();

// Define the API key and URL for the WEATHER data
const apiKey = '08391444ee550fdbdafe8836d41bae7a'; // your_api_key
const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${destination}&appid=${apiKey}&units=metric`;

// Fetch the current weather data for the location
fetch(apiUrl)
    .then(response => response.json())
    .then(data => displayWeather(data))
    .catch(error => console.log('Error fetching weather data:', error));

// Display the weather data on the page
function displayWeather(data) {
  const temperature = data.main.temp;
  const description = data.weather[0].description;
  const weatherInfo = `
    <p><b>Current Weather in ${destination}:</b></p>
    <p>Temperature: ${temperature}°C</p>
    <p>Weather: ${description.charAt(0).toUpperCase() + description.slice(1)}</p>
    `;

    // Display the weather information in the weather-info div
      document.getElementById("weather-info").innerHTML = weatherInfo;
}