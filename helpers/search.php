<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "journeymastersdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the search query
$query = $_POST['query'];

// Prepare SQL statement to search for places
$result = $conn->query("SELECT varos FROM helyszin WHERE varos LIKE '%$query%'");

// Check if query execution was successful
if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Convert result into an associative array
$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}
// Output the filtered places in a dropdown menu
if (!isset($elozo))
{
    $elozo[] = array();
}
echo '<ul class="search">';
foreach ($rows as $row) {
    if (!in_array($row['varos'], $elozo))
    {
        echo '<li onclick="selectPlace(\'' . $row['varos'] . '\')">' . $row['varos'] . '</li><br>';
    }
    $elozo[] = $row['varos'];
}
echo '</ul>';


// Close connection
$conn->close();


?>
