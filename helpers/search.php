<?php
// Adatbázis kapcsolat paraméterek
$servername = "localhost";
$username = "root";
$password = "";
$database = "journeymastersdatabase";

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $database);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search query megszerzése
$query = $_POST['query'];

// Helykereső SQL
$result = $conn->query("SELECT varos FROM helyszin WHERE varos LIKE '%$query%'");

// Sikeres volt-e a lekérdezés
if ($result === false) {
    die("Query failed: " . $conn->error);
}

$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}
// Helyek kiírása dropdown-ba
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

$conn->close();


?>
