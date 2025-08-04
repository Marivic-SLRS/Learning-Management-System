<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel = "icon" type ="image/x-icon" href = "http://localhost/Learning%20Management%20System/images/logo.png">
<style><!--dito komuna nilagay pag sa css ayaw eh-->
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
</style>
</head>
<body>
  <div class="wrapper">
  <?php  include 'dbconnections/dbadminlogin.php'; ?><!--dito tinawag natin yung database connection-->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <h1>Admin Login</h1>
     <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $username = $_POST["username"];
          $password = $_POST["password"];

          // Validate username and password (you should add more robust validation)
          if (!empty($username) && !empty($password)) {
              // SQL injection protection eto daw para sa security ng database try ko alisin gumagana naman
             $username = mysqli_real_escape_string($conn, $username);

              // Query to fetch user data for the given username eto yung pagkuha ng data sa database yung select na
              $sql = "SELECT id, username, password FROM users WHERE username='$username'";
              $result = $conn->query($sql);

              if ($result->num_rows == 1) { //eto number yung id eh admin to edi iisa lang yung id natin para dun
                  $row = $result->fetch_assoc();
                  $stored_password = $row["password"];

                  // eto code na to dito na siya mag if kung succes mag proceed sa admin.php pag hindi else yung lalabas
                  if ($password === $stored_password) {
                      // Login successful $row dito parang command para makuha mo yung data sa database ganun pag ka intindi ko
                      session_start(); // Start the session if not already started
                      $_SESSION["username"] = $row["username"]; // Store username in session
                      $_SESSION["user_id"] = $row["id"]; // Optionally, store user ID in session
                      header("Location: 1admin\dashboard.php"); // Redirect to admin.php nag declare siya location saan pupunta
                      exit();
                  } else {
                      echo "<div class='error'>Incorrect password. Please try again.</div>";
                  }
              } else {
                  echo "<div class='error'>Username not found.</div>";
              }
          } else {
              echo "<div class='error'>Username and password are required.</div>";
          }
      }
        ?>

      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required>
        <i class='bx bxs-user'  style='color: black;'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password"id ="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'  style='color: black;'></i>
     
	 </div>
      <div class="remember-forgot">
 <label><input type="checkbox" onclick="myFunction()">Show Password</label>
        <a href="Aforgotpass.php">Forgot Password</a>
      </div>
      <button type="submit" class="btn">Login</button>
     <br>
      <div class="return" style="color:white; text-align:center;">
      <br>
        <p><a href="index.php">Return</a></p>
      </div>
      <br>
      
      
    </form>
   <script>
function myFunction() {
    var x = document.getElementById("password");
   
    
    if (x.type === "password") {
        x.type = "text";
      
    } else {
        x.type = "password";
      
    }
}
</script>
</div>
</body>
</html>
