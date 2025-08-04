<?php
$conn = mysqli_connect("localhost","root","","admin_dashboard") ;

if (!$conn)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>