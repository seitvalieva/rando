
// WEATHER INFO with OpenWeather API

// Get the location for weather from the destination element
const departure = document.getElementById("departure").innerText.split(":").pop().trim();

// Define the API key and URL for the WEATHER data
const apiKey = '08391444ee550fdbdafe8836d41bae7a'; // your_api_key
const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${departure}&appid=${apiKey}&units=metric`;

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
    <p><b>Current Weather in ${departure}:</b></p>
    <p>Temperature: ${temperature}°C</p>
    <p>Weather: ${description.charAt(0).toUpperCase() + description.slice(1)}</p>
    `;

    // Display the weather information in the weather-info div
      document.getElementById("weather-info").innerHTML = weatherInfo;
}