<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
  
    header("Location: adminlogin.php"); // Change this to your actual login page
    exit();
}
// Display the first name and last name from the session
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
$full_name = $_SESSION["first_name"] . " " . $_SESSION["last_name"];



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">
    <!-- Include your CSS stylesheets or links here -->
</head>
<body>
    <h1>Welcome, <?php echo "$full_name!"; ?>!</h1>
    <!-- Admin content here -->
    <p>This is the student dashboard.</p>
    <a href="index.php">Logout</a> <!-- Link to logout.php for logging out -->
</body>
</html>
