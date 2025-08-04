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
	
	<?php
include 'dbconnections/dbadminlogin.php';
  if (isset($_SESSION["reset_employeeId"])) {
	   $reset_employeeId= $_SESSION["reset_employeeId"];
	    //echo "<div style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Username: $reset_employeeId</div>";
		if (!empty($reset_employeeId)) {
			$sql = "SELECT 	code FROM facultys WHERE employee_id='$reset_employeeId'";
			$result = $conn->query($sql);
			if ($result->num_rows == 1) {
	       $row = $result->fetch_assoc();
           $dbcode = $row["code"];  
		   if (isset($_GET["code"])) {
          $code = $_GET["code"];                          
           if ($code === $dbcode) {
         $_SESSION["reset_employeeId"] = $reset_employeeId;
		 $_SESSION["employeeId"] = $row["employeeId"]; 
        $redirect_url = "Tnew-password.php?employeeId=" . urlencode($reset_employeeId);
		header("Location: $redirect_url"); // Redirect to Anew-password.php                      
        exit();
       } else {
       header("Location: Tdenied.php"); // Redirect to Adenied.php if the codes don't match
      exit();
                                }                         
                            }
  }}}
				?>
	
        <div class="row">
            <div class="col-md-4 offset-md-4 form" style="background-color:rgba(250,250,250,0.7);"> <br>
             <form id="verificationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" autocomplete="">
                    <h2 class="text-center">Code Verification</h2>
                    <p class="text-center">Enter your Code</p>
                    <div class="form-group">
                        <input class="form-control" type="number" id="code" name="code" placeholder="Enter code" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" id="continueButton">Continue</button>
                    </div>
                </form> <br> 
            </div>
        </div>
    </div>

    <script>
        document.getElementById("verificationForm").addEventListener("submit", function(event) {
            event.preventDefault();
            
            var otpValue = document.getElementById("code").value;
            if (otpValue.trim() === "") {
                alert("Fill up First");
                return;
            }

            // Submit the form for verification
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); // This will post to the same page
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText.trim() === "success") {
                        // Code is correct, proceed to password-reset.php
                        window.location.href = "Snew-password.php?studentId=" . encodeURIComponent(<?php echo json_encode($studentId); ?>);
                    } else {
                        // Code is incorrect, display an error message
                        alert("Incorrect code or student ID. Please try again.");
                    }
                }
            };
            xhr.send("otp=" + otpValue + "&studentId=" + <?php echo json_encode($studentId); ?>);
        });
    </script>
</body>
</html>

