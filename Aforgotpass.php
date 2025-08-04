<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">


</head>
<body>
 


    <div class="container">
    <?php include 'dbconnections/dbadminlogin.php'; ?>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["username"])) {
                $username = $_GET["username"];
                if (!empty($username)) {
                    $username = mysqli_real_escape_string($conn, $username);
                    $sql = "SELECT username FROM users WHERE username='$username'"; //command
                    $result = $conn->query($sql); //execute command

                    if ($result->num_rows == 1) { // check if has one record
                        $row = $result->fetch_assoc();
                        $dbusername = $row["username"];
                        if ($username === $dbusername) { //if same and inputed username sa nasa db
                            session_start();
                            $_SESSION["reset_username"] = $username;
                            $_SESSION["username"] = $row["username"];    
                            $redirect_url = "Aresetcode.php?username=" . urlencode($username); // Redirect to Aresetcode.php with the username in the query string
                            header("Location: $redirect_url"); 
                            exit();                          
                        } else {
                            echo "<div class='error'>Incorrect username. Please try again.</div>";
                        }
                    } else {
                        echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Username not found!</div>";
                    }
                } else {
                    echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Username is required.</div>";
                }
            }
        }
        ?>

       <div class="row">
    <div class="col-md-4 offset-md-4 form" style="background-color:rgba(250,250,250,0.7);">
            <form id="forgotPasswordForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" autocomplete="">
               <br>
               <h2 class="text-center">Forgot Password</h2>
                <p class="text-center">Enter your Username</p>
                <div class="form-group">
                    <input class="form-control" type="text" name="username" id="username" placeholder="Enter username" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" id="continueButton">Continue</button>
                </div>
            </form>
        </div>
    </div>
    </div>

   
</body>
</html>
