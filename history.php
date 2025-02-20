<?php 
include 'db.php';

$sql = "SELECT * FROM weather_history ORDER BY search_date DESC";
$result = $conn->query($sql);

echo "<h1>Search History</h1>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>{$row['location']} - {$row['temperature']}°C, {$row['description']} ({$row['search_date']})</p>";
    }
} else {
    echo "<p>No search history found.</p>";
}
$conn->close();
?>