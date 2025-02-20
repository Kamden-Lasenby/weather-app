<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';
//just changed
$location = $_GET['location'];
$apiKey = '96d85292e418cf54597263a8eab8cc8c'; // Replace with your actual API key
$apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$location}&appid={$apiKey}&units=metric";

$response = file_get_contents($apiUrl);
if ($response === FALSE) {
    die(json_encode(['error' => 'Failed to fetch weather data']));
}

$data = json_decode($response, true);

if ($data['cod'] == 200) {
    $temperature = $data['main']['temp'];
    $description = $data['weather'][0]['description'];

    // Prepare the SQL query
    $sql = "INSERT INTO weather_history (location, temperature, description, search_date) VALUES (?, ?, ?, NOW())";
    error_log("SQL Query: " . $sql);

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        die(json_encode(['error' => 'Database error: Prepare failed']));
    }

    // Bind parameters and execute
    $stmt->bind_param("sds", $location, $temperature, $description);
    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error);
        die(json_encode(['error' => 'Database error: Execute failed']));
    }

    $stmt->close();

    echo json_encode([
        'location' => $location,
        'temperature' => $temperature,
        'description' => $description
    ]);
} else {
    echo json_encode(['error' => 'Location not found']);
}
$conn->close();
?>