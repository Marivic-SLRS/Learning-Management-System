
<?php
 
$fullname = $_SESSION["fullname"];
$class = $_SESSION["assigned_class"];
$exam_title = isset($_SESSION['exam_title']) ? $_SESSION['exam_title'] : '';
$subject = isset($_SESSION['Subject']) ? $_SESSION['Subject'] : '';
$teachername = isset($_SESSION['Teacher']) ? $_SESSION['Teacher'] : '';
$scores = isset($_SESSION['score']) ? $_SESSION['score'] : '';









?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Learning Management System</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/Learning%20Management%20System/images/logo.png">
    
    
    <!--i dont for what tong mga toh-->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/3.0.2/buttons.bootstrap4.min.css"> 
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://unpkg.com/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css">  
    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- JQVMap --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="http://localhost/Learning%20Management%20System/css/custom.css">
    

    <!---has visual purpose-->
    <!-- Theme style --> <!--for layout-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- overlayScrollbars --> <!--for side bar and scroll bar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.10.1/css/OverlayScrollbars.css">
    <!-- Daterange picker --> <!--for fix layout-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css">
    <!--for icons-->
    <link rel="stylesheet" type= "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style type="text/css">/* Chart.js */
      @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>

    <!--for actions-->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        var _base_url_ = 'http://localhost/Learning%20Management%20System/';
    </script>
    <script src="http://localhost/Learning%20Management%20System/js/scripts.js"></script>
    
    
    <style>
    body {
        font-family: Georgia, 'Times New Roman', Times, serif;
        background-color: #f0f0f0;
        padding: 20px;
    }

    .question-card {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px;
    margin-left: auto; /* Center the element horizontally */
    margin-right: auto; /* Center the element horizontally */
}


    .question-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .question-details {
        margin-bottom: 10px;
    }

    .question-details span {
        font-weight: bold;
    }

    .question-choices {
        margin-bottom: 10px;
    }

    .choices-list {
        margin-left: 20px;
    }

    .header {
            background-color: #25383C; 
            color: #fff; 
            padding: 50px; /* Padding around content */
            text-align: center; /* Center-align text */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Shadow effect */
        }

    .color{
            text-align: center;
            background-color: #FFFFFF; 
            color: #000000;
    }

    .buttonleft{  
            text-align: left;
            background-color: #FFFFFF; 
            color: #000000;
            width: 80px;
    }
    .buttonleft a {
    display: inline-block; 
    text-decoration: none; 
    color: inherit; 
   
    }

    .buttonleft p {
        display: inline; 
        margin: 0; 
        vertical-align: middle; 
    }

    </style>
  
</head>  

<body class="layout-fixed layout-footer-fixed text-sm header" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto; font-family: georgia;">






<br><br><br><br>
      <h1  style = "font-size: 50px;"><?php echo $exam_title; ?></h1>
      <p style = "font-family: sans-serif;margin:0%;">Subject: <?php echo $subject; ?></p>
      
      <p style = "font-family: sans-serif;">Teacher: <?php echo $teachername; ?></p>

<!--answer form-->

<br><br><br>
<div class = "color question-card">

    <h3>Your score: </h3>
    <p style="font-size:40px;"><?php echo $scores; ?></p>
</div>



<a href="http://localhost/Learning%20Management%20System/2student/quiz.php" style="background-color: white; padding: 10px; margin: 20px; border-radius: 8px; color: black; text-decoration: none;">
    <i class="fas fa-caret-left"></i>
    Back
</a>










</bod>
</html>
