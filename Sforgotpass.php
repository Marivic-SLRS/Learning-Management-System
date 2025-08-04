
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Forgot Password</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">
<Style>
.error {
    color: #dc3545; /* Red color for error messages */
    background-color: #f8d7da; /* Light red background */
    border: 1px solid #f5c6cb; /* Border color */
    border-radius: 5px; /* Rounded corners */
    padding: 10px 15px; /* Padding around the text */
    margin-bottom: 15px; /* Increased margin for better spacing */
    text-align: center; /* Center-align the text */
    font-size: 16px; /* Font size */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
}
</Style>
</head>
<body>
    <div class="container">
	<?php
    // Include database connection
    include 'dbconnections/dbadminlogin.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit"])) {
        $studentId = $_GET["studentId"];
        if (!empty($studentId)) {
            $studentId = mysqli_real_escape_string($conn, $studentId);
            $sql = "SELECT * FROM student WHERE Student_Id='$studentId'"; // Query to fetch student by Student_Id
            $result = $conn->query($sql); // Execute query

            if ($result && $result->num_rows == 1) { // Check if a record is found
                $row = $result->fetch_assoc();
                session_start();
                $_SESSION["reset_studentId"] = $studentId;
                $_SESSION["studentId"] = $row["Student_Id"];
                $redirect_url = "Sresetcode.php?studentId=" . urlencode($studentId); // Redirect to Aresetcode.php with the studentId in the query string
                header("Location: $redirect_url");
                exit();
            } else {
                echo "<div class='error'>Student ID not found. Please try again.</div>";
            }
        } else {
            echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Student ID is required.</div>";
        }
    }
?>


        <div class="row">
            <div class="col-md-4 offset-md-4 form" style="background-color:rgba(250,250,250,0.7);"> <br>
               <form id="forgotPasswordForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your Student ID</p>
                    <div class="form-group">
                        <input class="form-control" type="text" name="studentId" id="studentId" placeholder="Enter Student ID" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="continueButton" name="submit">Continue</button>
                    </div>
                </form> <br> 
            </div>
        </div>
    </div>
</body>
</html>
