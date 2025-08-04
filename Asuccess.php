<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Change Success</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> 
    <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center" style="background-color:rgba(250,250,250,0.7);"> <br> 
                <h2>Password Change Successful</h2>
                <p>Your password has been successfully changed.</p>
                <button onclick="goToHome()" class="btn btn-primary">Home</button> 
                <br> <br>
            </div> 
        </div>
    </div>

    <script>
        function goToHome() {
            window.location.href = "index.php";
        }
    </script>
</body>
</html>
