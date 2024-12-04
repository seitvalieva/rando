// LEAFLET interactive MAP
const city = document.getElementById("destination").innerText.split(":").pop().trim(); // location
// console.log(city);
const apiUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(city)}&format=json&addressdetails=1`;

// Fetch coordinates for the city name
fetch(apiUrl)
  .then(response => response.json())
  .then(data => {
    if (data && data.length > 0) {
        const lat = data[0].lat; // Latitude
        const lon = data[0].lon; // Longitude
      
    // Initialize the map with the obtained coordinates
        var map = L.map('map').setView([lat, lon], 13); // 13 is the zoom level
        
    // Add a tile layer (e.g., OpenStreetMap tiles)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);
        
      // Add a marker at the city's location
      L.marker([lat, lon]).addTo(map)
        .bindPopup(`City: ${city}`)
        .openPopup();
    } else {
        // const city = 'Strasbourg';
      console.error("No results found for the city.");
    }
  })
  .catch(error => console.error("Error fetching coordinates:", error));

// WEATHER INFO with OpenWeather API

// Get the location for weather from the departure
const departure = document.getElementById("departure").innerText.split(":").pop().trim();

// Define the API key and URL for the WEATHER data
const apiKey = '08391444ee550fdbdafe8836d41bae7a'; // your_api_key
// const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${departure}&appid=${apiKey}&units=metric`;

// Fetch the current weather data for the location
fetch(`https://api.openweathermap.org/data/2.5/weather?q=${departure}&appid=${apiKey}&units=metric`)
    .then(response => response.json())
    .then(data => displayWeather(data))
    .catch(error => console.log('Error fetching weather data:', error));

// Display the weather data on the page
function displayWeather(data) {
  const temperature = data.main.temp;
  const description = data.weather[0].description;
  const weatherInfo = `
    <h2><b>Current Weather in ${departure}:</b></h2>
    <p>Temperature: ${temperature}°C</p>
    <p>Weather: ${description.charAt(0).toUpperCase() + description.slice(1)}</p>
    `;

    // Display the weather information in the weather-info div
      document.getElementById("weather-info").innerHTML = weatherInfo;
}