<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Login</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">
   
</head>
<body>
<div class="wrapper">
    <?php
    include 'dbconnections/dbadminlogin.php'; // Include the file that initializes the database connection
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1>Teacher Login</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Validate username and password (you should add more robust validation)
            if (!empty($username) && !empty($password)) {
                // SQL injection protection
                $username = mysqli_real_escape_string($conn, $username);

                // Query to fetch user data for the given username
                $sql = "SELECT id, employee_id, password FROM facultys WHERE employee_id='$username'";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $password_from_db = $row["password"]; // This is the password fetched from the database

                    if ($password === $password_from_db) {
                        // Login successful
                        session_start(); // Start the session if not already started

                        // Retrieve the full name from the database based on the username
                        $sql_fullname = "SELECT fullname FROM facultys WHERE employee_id='$username'";
                        $result_fullname = $conn->query($sql_fullname);
                        if ($result_fullname->num_rows == 1) {
                            $row_fullname = $result_fullname->fetch_assoc();
                            $fullname = $row_fullname["fullname"];

                            // Store username and full name in session
                            $_SESSION["username"] = $username; // Store username in session
                            $_SESSION["fullname"] = $fullname; // Store full name in session
                            $_SESSION["user_id"] = $row["id"]; // Optionally, store user ID in session

                            // Fetch the assigned class for the teacher
                            $sql_assigned_class = "SELECT class FROM facultys WHERE id = {$_SESSION['user_id']}";
                            $result_assigned_class = $conn->query($sql_assigned_class);
                            if ($result_assigned_class->num_rows > 0) {
                                $row_assigned_class = $result_assigned_class->fetch_assoc();
                                $assigned_class = $row_assigned_class["class"];
                                $_SESSION["assigned_class"] = $assigned_class; // Store assigned class in session
                            }

                            // Redirect to dashboard.php
                            header("Location: 3teacher/dashboard.php");
                            exit();
                        } else {
                            // Handle case where full name is not found
                            echo "<div class='error'>Full name not found.</div>";
                        }
                    } else {
                        // Handle case where password does not match
                        echo "<div class='error'>Incorrect password. Please try again.</div>";
                    }
                } else {
                    // Handle case where username is not found
                    echo "<div class='error'>Username not found.</div>";
                }
            } else {
                // Handle case where username or password is empty
                echo "<div class='error'>Username and password are required.</div>";
            }
        }
        ?>
        <div class="input-box">
            <input type="text" name="username" placeholder="Employee ID" required>
            <i class='bx bxs-user'  style='color: black;'></i>
        </div>
        <div class="input-box">
            <input type="password" name="password" id="pass" placeholder="Password" required>
            <i class='bx bxs-lock-alt'  style='color: black;'></i>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox" name="remember" onclick="show()">Show Password</label>
            <a href="Tforgotpass.php">Forgot Password</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="return" style="color:white; text-align:center;">
            <br>
            <p><a href="index.php">Return</a></p>
        </div>
        <br>
    </form>
</div>
<script>
    function show() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>



</body>
</html>
