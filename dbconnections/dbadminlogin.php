<?php
 // Start the session para manage ang user login state

$servername = "localhost";
$username = "root"; // pangalan ng database username
$password = ""; // yung database password
$dbname = "admin_dashboard";//tapos name ng database na ginawa

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}//eto yung pano mag connect sa database na code tapos tatawagin ang name file neto kung gusto mo mag connect

?>