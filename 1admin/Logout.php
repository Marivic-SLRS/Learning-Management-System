<?php
// Start the session to access session variables

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to index.php
header("Location: http://localhost/Learning%20Management%20System/index.php");
exit();
?>
