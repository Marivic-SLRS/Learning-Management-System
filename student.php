<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="login.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">

</head>
<body>     
  <div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <h1>Student Login</h1>
      <?php
      include 'dbconnections/dbadminlogin.php'; 

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $student_id = $_POST["username"];//eto erro kanina  dapat lower case yung s pero sa database upper dapat daw sa php lower sabi ni google 
          $password = $_POST["password"];

          if (!empty($student_id) && !empty($password)) {//kinuha na lahat para sa student dashboard mapalabas name
              $stmt = $conn->prepare("SELECT id, full_name, Student_id, password FROM student WHERE Student_id= ?");
              $stmt->bind_param("s", $student_id);

              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows == 1) {
                  $row = $result->fetch_assoc();
                  $stored_password = $row["password"];

                  if ($password === $stored_password) { //eto yun password na pahirap ganyan nalang talaga  
                      // Retrieve the full name from the database based on the username
                        $fullname = $row["full_name"];

                        // Store username and full name in session
                        $_SESSION["username"] = $username; // Store username in session
                        $_SESSION["fullname"] = $fullname; // Store full name in session
                        $_SESSION["user_id"] = $row["id"]; // Optionally, store user ID in session
                        // Fetch the assigned class for the student
                        $sql_assigned_class = "SELECT classs FROM student WHERE id = {$_SESSION['user_id']}";
                        $result_assigned_class = $conn->query($sql_assigned_class);
                        if ($result_assigned_class->num_rows > 0) {
                            $row_assigned_class = $result_assigned_class->fetch_assoc();
                            $assigned_class = $row_assigned_class["classs"];
                            $_SESSION["assigned_class"] = $assigned_class; // Store assigned class in session
                        }

                        // Redirect to dashboard.php
                        header("Location: 2student\dashboard.php");
                        exit();
                  } else{
                    echo "<div class='error'>Incorrect password. Please try again. </div>";
                  }

              } else {
                  echo "<div class='error'>Student ID not found.</div>";
                 
              }
             
          }else {
              echo "<div class='error'>Student ID and password are required.</div>";
           
        }
       
         
	  } 
  
      ?>
	  
      <div class="input-box">
        <input type="text" name="username" placeholder="Student ID" required>
        <i class='bx bxs-user'  style='color: black;'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password"id="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'  style='color: black;'></i>
      </div>
      <div class="remember-forgot">
       <label><input type="checkbox" onclick="show()">Show Password</label>
        <a href="Sforgotpass.php">Forgot Password</a>
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
    var x = document.getElementById("password");
   
    
    if (x.type === "password") {
        x.type = "text";
      
    } else {
        x.type = "password";
      
    }
}
</script>
</body>
</html>
