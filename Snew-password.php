<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">
</head>
<body>
    <div class="container">
 <?php
include 'dbconnections/dbadminlogin.php';

 if (isset($_SESSION["reset_studentId"])) {    
            $reset_studentId = $_SESSION["reset_studentId"];
            //echo "<div style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Username: $reset_studentId</div>";  
               if (isset($_POST['change-password'])) {             
                    $password = $_POST['password'];
                    $cpassword = $_POST['cpassword']; 
					 if ($password !== $cpassword) {
                        echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Passwords do not match. Please try again.</div>";
                    } else {
                        $sql = "UPDATE student SET password = '$password' WHERE Student_id ='$reset_studentId'";
						
                        if ($conn->query($sql)) {                       
                            $_SESSION["Student_id"] = $reset_studentId;                           
                            $redirect_url = "Ssuccess.php?Student_id=" . urlencode($reset_studentId);
                            header("Location: $redirect_url");
                            exit();
                        } else {
                            echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Error updating password: " . $conn->error . "</div>";
                            echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>SQL Query: $sql</div>";
                        }
                    }                
            }
        } else {
            echo "<div class='error' style='font-family: Georgia; font-size: 18px; color: black; text-align: center;'>Reset Student not found.</div>";
        }
    ?>
						

       

         <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-4 offset-md-4 form" style="background-color:rgba(250,250,250,0.7);"> <br> 
                                <form id="newPasswordForm" action="Ssuccess.php" method="POST" autocomplete="off">
                                    <h2 class="text-center">New Password</h2>
                                    <div class="form-group">
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Create new password" required>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="Confirm your password" required>
                                    <input type="checkbox" onclick="myFunction()" style="margin: 10px; vertical-align: middle;"> 
                                    <label style="font-size: 14px; font-weight: normal; color: #666;">Show Password</label>
</div>
                                    <div class="form-group">
                                        <input class="form-control button" type="submit" name="change-password" value="Change">
										
                                    </div>
                                </form> <br>
                            </div>
                        </div>
                    </div>
                </form>
   


   
                <script>
function myFunction() {
    var x = document.getElementById("password");
    var y = document.getElementById("cpassword");
    
    if (x.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}

						
						
						
						
						
						
						
						
						
						
						
						document.getElementById("newPasswordForm").addEventListener("submit", function(event) {
                            event.preventDefault(); 
                            
                            var password = document.getElementById("password").value;
                            var cpassword = document.getElementById("cpassword").value;
                            
                            if (password !== cpassword) {
                                alert("Passwords do not match. Please try again.");
                                return; 
                            }
                        });
                    </script>
</body>
</html>
