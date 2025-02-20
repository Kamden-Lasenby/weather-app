<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, inital-scale=1.0">
  <title>Weather App</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Weather App</h1>
  <form id="weatherForm">
    <input type="text" id="location" placeholder="Enter city name" required>
    <button type="submit">Get Weather</button>
  </form>
  <div id="weatherResult"></div>
  <a href="history.php">View Search History</a>
  <script src="script.js"></script>
</body>
</html>