// here we are attaching an eventlistner to our weatherform
document.getElementById('weatherForm').addEventListener('submit', function (e) {

    // stops the page from reloading upon submission (the default behavior)
    e.preventDefault();

    const location = document.getElementById('location').value;

    fetch(`api.php?location=${encodeURIComponent(location)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const weatherResult = document.getElementById('weatherResult');
            if (data.error) {
                weatherResult.innerHTML = `<p>${data.error}</p>`;
            } else {
                weatherResult.innerHTML = `
                    <h2>${data.location}</h2>
                    <p>Description: ${data.description}</p>
                    <p>Temperature: ${data.temperature}°C</p>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const weatherResult = document.getElementById('weatherResult');
            weatherResult.innerHTML = `<p>Failed to fetch weather data. Please try again.</p>`;
        });
});