<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Access Denied</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your custom style sheet -->
    <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center" style="background-color:rgba(250,250,250,0.7);"> <br>
                
                    <h2 style="background-color: rgba(255, 255, 255,0);" style="font-size: smaller;">Access Denied</h2>
                    <p style="background-color: rgb(250,250,250,0);" style="font-size: smaller;">You've Entered a  Wrong Code</p>
                
                <button onclick="goToHome()" class="btn btn-primary">Home</button>
                <button onclick="tryagain()" class="btn btn-primary">Tryagain</button>
				
				<br> <br>
            </div>
        </div>
    </div>

    <script>
        function goToHome() {
            window.location.href = "index.php";
        }
		function tryagain() {
            window.location.href = "Sforgotpass.php";
        }
		
    </script>
</html>
