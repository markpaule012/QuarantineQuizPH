<?php
$servername = "sql110.epizy.com";
$username = "epiz_25436611";
$password = "4Sy2rR0DqZZ";
$dbname = "epiz_25436611_scores";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>