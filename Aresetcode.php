<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">
</head>
<body>
    <div class="container">
    <?php include 'dbconnections/dbadminlogin.php';
            if (isset($_SESSION["reset_username"])) {
                $reset_username = $_SESSION["reset_username"];
                echo "<div style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Username: $reset_username</div>";
                if (!empty($reset_username)) {              
                    $sql = "SELECT code FROM users WHERE username='$reset_username'";
                    $result = $conn->query($sql);
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        $dbcode = $row["code"];                     
                        if (isset($_GET["code"])) {
                            $code = $_GET["code"];                          
                                if ($code === $dbcode) {
                                    $_SESSION["reset_username"] = $reset_username;
                                    $_SESSION["username"] = $row["username"]; 
                                    $redirect_url = "Anew-password.php?username=" . urlencode($reset_username);
                                    header("Location: $redirect_url"); // Redirect to Anew-password.php                      
                                    exit();
                                } else {
                                    header("Location: Adenied.php"); // Redirect to Adenied.php if the codes don't match
                                    exit();
                                }                         
                            }
                        } else {
                            echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Code is required.</div>";
                        }
                    } else {
                        echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Username not found!</div>";
                    }
                } else {
                    echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Username is required.</div>";
                }

        ?>



        <div class="row">
            <div class="col-md-4 offset-md-4 form" style="background-color: rgba(250,250,250,0.7);"> <br>
                <form id="verificationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" autocomplete="">
                    <h2 class="text-center">Code Verification</h2>
                    <p class="text-center">Enter your Code</p>
                    <div class="form-group">
                        <input class="form-control" type="number" id="code" name="code" placeholder="Enter code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-reset-otp" value="Submit"> <br> <br>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("verificationForm").addEventListener("submit", function(event) {
            var codeValue = document.getElementById("code").value;
            if (codeValue.trim() === "") {
                event.preventDefault();
                alert("Please fill in the code field.");
            }
        });
    </script>
</body>
</html>
