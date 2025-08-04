<?php
 // Start the session to access session variables

// Check if the user is logged in
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    // If not logged in, redirect to tadminlogin.phphe login page
    header("Location: adminlogin.php"); // Change this to your actual login page
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset'])) {
  resetSemester();
}

function resetSemester() {
  // Database connection settings
  $servername = "localhost";
  $username = "root"; // pangalan ng database username
  $password = ""; // yung database password
  $dbname = "admin_dashboard";//tapos name ng database na ginawa
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // SQL queries to truncate the tables
  $sql_files = "TRUNCATE TABLE files";
  $sql_activity = "TRUNCATE TABLE activity";
  $sql_major = "TRUNCATE TABLE major";
  $sql_tbl_events = "TRUNCATE TABLE tbl_events";

  // Execute the queries
  if ($conn->query($sql_files) === TRUE && $conn->query($sql_activity) === TRUE && $conn->query($sql_major) === TRUE && $conn->query($sql_tbl_events) === TRUE) {
      // SQL query to delete data from specific columns in the student table
      $sql_update_student = "UPDATE student SET examscores = NULL, quizscores = NULL";
      
      if ($conn->query($sql_update_student) === TRUE) {
          $_SESSION['error'] = 'Started a new Semester ';
          
      } else {
          $_SESSION['error'] = 'Error resetting student scores: '. $conn->error;
      }
  } else {
      $_SESSION['error'] = 'Error resetting tables: '. $conn->error;
  }
  
  header("Location: ".$_SERVER['PHP_SELF']);
  exit();

  // Close connection

}



//messsage 1
if (isset($_SESSION['error'])) {
echo '<script>alert("'. $_SESSION['error']. '");</script>';
unset($_SESSION['error']); 
}


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

  </head>  


  <body class="layout-fixed layout-footer-fixed text-sm sidebar-mini control-sidebar-slide-open layout-navbar-fixed " data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto; font-family: georgia;">
   
  <div class="wrapper">
     <!-- upper bar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm" style="font-family:georgia;background-color:rgb(100, 0, 0); border-bottom-right-radius: 8px;border-bottom-left-radius: 8px;">
        <!-- Left navbar -->
        <ul class="navbar-nav">
          
          <li class="nav-item d-none d-sm-inline-block">
            <a href="http://localhost/Learning%20Management%20System/1admin/dashboard.php" class="nav-link" style="font-family:georgia;font-size:18px;color:white;">Learning Management System</a>
          </li>
        </ul>
        <!-- Right navbar  -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link"  href="http://localhost/Learning%20Management%20System/1admin/about.php" role="button" style="color:white;"> <!--link to system info-->
            <i class="fa-solid fa-bullseye"></i>
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)" onclick="confirmLogout()" role="button" style="color:white;">
              <i class="fas fa-sign-out-alt"></i>
          </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:white;"></i></a>
          </li>
        </ul>
      </nav>
      <!-- upper bar -->  
      
    
     
      <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 " style="background-color:transparent;" >
    
        <!-- Sidebar -->
         <div style="background-color:#008080; width: 100%; height: 46px; display: inline-block;border-bottom-right-radius: 8px;border-bottom-left-radius: 8px;"></div>
       
        <div class="sidebar  os-theme-light os-host-overflow  os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden" style="background-color:rgb(100, 0, 0); border-radius: 8px;margin-top: -5px;">
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
              
              <br><br>
              <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image" >
                    <img src="http://localhost/Learning%20Management%20System/images/adminpic.png" class="img-circle elevation-2" alt="User Image" style="height: 3rem;width:3rem; object-fit: cover;background-color: white;">
                  </div>
                  <div class="info">
                    <a href="http://localhost/Learning%20Management%20System/1admin/admin_acc.php" class="d-block" style="margin:7px;" style="font-family: georgia;">Admin</a> <!--link to admin acc settings-->
                  </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                   <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false" style="font-family: georgia; font-size: 14px;">
                    <li class="nav-item dropdown" >
                      <a href="http://localhost/Learning%20Management%20System/1admin/dashboard.php#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li> 
                    <li class="nav-header">List</li>
                    <li class="nav-item dropdown" >
                      <a href="http://localhost/Learning%20Management%20System/1admin/department.php" class="nav-link "> <!--link to class-->
                        <i class="nav-icon fas fa-light fa-school"></i>
                        <p>
                          Department
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/1admin/class.php" class="nav-link "><!--link to-->
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                          Class
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/1admin/subject.php" class="nav-link "> <!--link to class-->
                        <i class="nav-icon fas fa-light fa-book"></i>
                        <p>
                          Subject
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/1admin/teacher.php" class="nav-link "> <!--link to class-->
                        <i class="nav-icon fas fa-solid fa-users"></i>
                        <p>
                          Teachers
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/1admin/student.php" class="nav-link "><!--link to class-->
                        <i class="nav-icon fas fa-solif fa-user-graduate"></i>
                        <p>
                          Students
                        </p>
                      </a>
                    </li>
                     
                    <!--maintenane part-->
                    <li class="nav-header">Maintenance</li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/1admin/teacher_acc.php" class="nav-link "> <!--link to class-->
                        <i class="nav-icon fas fa-user-gear"></i>
                        <p>
                          Teachers Account
                        </p>
                      </a>
                    </li>
                   
                    <li class="nav-item dropdown" style = "background-color:rgb(178, 24, 7); border-radius: 10px;">
                      <a href="http://localhost/Learning%20Management%20System/1admin/school_year.php" class="nav-link "> <!--link to class-->
                        <i class="nav-icon fas fa-calendar-days"></i>
                        <p>
                          School Year
                        </p>
                      </a>
                    </li>              
                  </ul>
                </nav>
                <!-- end of side menu -->
              </div>
            </div>
          </div>
        </div>
        <!-- end of sidebar  -->
    
      </aside>




    <script>
       //jQuery library snippet
    $(document).ready(function(){ //runs only after the DOM (Document Object Model) has been fully loaded and is ready for manipulation.
      var page = 'home'; // two variables page and s are initialized. page is set to 'home' initially, and s is an empty string.
      var s = '';
      page = page.split('/'); //This code splits the page variable using the forward slash / as the separator. However, since 'home' doesn't contain a forward slash, this operation doesn't have any practical effect. 
      page = page[0]; //it assigns the first part of the split result (index 0) back to the page variable, effectively doing nothing.
      if(s!='') //This conditional statement checks if the s variable is not an empty string. If s is indeed not empty, it appends an underscore followed by the value of s to the page variable. 
        page = page+'_'+s; //Since s is empty, this conditional block also doesn't affect the page variable.

      if($('.nav-link.nav-'+page).length > 0){  //This block checks if there is any element with a class of 'nav-link' and 'nav-' concatenated with the value of the page variable. If such an element exists, it proceeds to add classes and manipulate the navigation links based on certain conditions.
             $('.nav-link.nav-'+page).addClass('active') //This line adds the class 'active' to the navigation link that matches the selector '.nav-link.nav-'+page.
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){ 
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

        }
     //part of a navigation menu manipulation script that adds specific classes to certain navigation links based on predefined conditions, probably to indicate which page or section is currently active or expanded.
       })
    </script>    
    

  















<!--START OF THE CONTENT INSIDE-->
  






<!-- Contains page content -->
    <div class="content-wrapper" style="min-height: 567.854px;">
        
      <!-- Content Header (Page header) -->
        <div class="content-header" style="background-color:darkgray;border-radius: 10px;">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6" >
                <h4 class="m-0" style="font-family: georgia; font-size: 14px;">School Year -></h4>
              </div>
            </div>
          </div>
        </div>
      <!-- end of header -->
      <style>
        body {
            background-color: #640000;
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            
           
            justify-content: center;
            align-items: center;
        }
        .clock-container {
            position: absolute;
         
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background-color:  #640000;
            border-radius: 10px;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: move;
            transition: background-color 0.3s ease;
        }
        .clock-container:hover {
            background-color:  #640000;
        }
        .clock {
            font-size: 1.5em;
            font-weight: bold;
            color: #ecf0f1;
        }
        .period {
            font-size: 1em;
            margin-top: 5px;
            color: #ecf0f1;
        }
        #hours, #minutes, #seconds {
            display: inline-block;
            min-width: 2ch;
        }
    </style>
</head>
<body>
<div class="clock-container" id="clock-container" style="position: absolute;">
    <div class="clock" id="clock">
        <span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span>
    </div>
    <div class="period" id="period">AM</div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const period = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12 || 12; // convert 0 to 12
        hours = String(hours).padStart(2, '0');

        document.getElementById('hours').textContent = hours;
        document.getElementById('minutes').textContent = minutes;
        document.getElementById('seconds').textContent = seconds;
        document.getElementById('period').textContent = period;
    }

    setInterval(updateClock, 1000);
    updateClock();

    const clockContainer = document.getElementById('clock-container');
    let offsetX, offsetY;

    function startDrag(e) {
        const isTouchEvent = e.type.startsWith('touch');
        const clientX = isTouchEvent ? e.touches[0].clientX : e.clientX;
        const clientY = isTouchEvent ? e.touches[0].clientY : e.clientY;

        offsetX = clientX - clockContainer.getBoundingClientRect().left;
        offsetY = clientY - clockContainer.getBoundingClientRect().top;

        const moveHandler = (e) => {
            const clientX = isTouchEvent ? e.touches[0].clientX : e.clientX;
            const clientY = isTouchEvent ? e.touches[0].clientY : e.clientY;

            clockContainer.style.left = `${clientX - offsetX}px`;
            clockContainer.style.top = `${clientY - offsetY}px`;
        };

        const endHandler = () => {
            document.removeEventListener(isTouchEvent ? 'touchmove' : 'mousemove', moveHandler);
            document.removeEventListener(isTouchEvent ? 'touchend' : 'mouseup', endHandler);
        };

        document.addEventListener(isTouchEvent ? 'touchmove' : 'mousemove', moveHandler);
        document.addEventListener(isTouchEvent ? 'touchend' : 'mouseup', endHandler);
    }

    clockContainer.addEventListener('mousedown', startDrag);
    clockContainer.addEventListener('touchstart', startDrag);
</script>
</body>
    
    
    
    
    
    
    
     <style>
        button {
            float: right;
            background-color:  #640000;
            color: white;
            border-radius: 5px;
            border : none;
            cursor: pointer;
        }
    </style>

<br><br>
<form method="post" >
  <button name="reset" id="reset" style="float:right; background-color:  #640000;" onclick="return confirm('Are you sure you want to start a new semester? This action cannot be reversed.')">Start a New Semester</button>

</form>
     <html>
     
     
     
     
     
     <html>

<head>
<link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
<script src="fullcalendar/lib/jquery.min.js"></script>
<script src="fullcalendar/lib/moment.min.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>


<script>
$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "fullcalendar/fetch-event.php",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD ");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD ");

                $.ajax({
                    url: 'fullcalendar/add-event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                        window.location.reload(); // Reload the page
                    }
                });
                calendar.fullCalendar('renderEvent',
                    {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true
                );
            }
            calendar.fullCalendar('unselect');
        },
        editable: true,
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD ");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD ");
            $.ajax({
                url: 'fullcalendar/edit-event.php',
                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                type: "POST",
                success: function (response) {
                    displayMessage("Updated Successfully");
                    window.location.reload(); // Reload the page
                }
            });
        },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "fullcalendar/delete-event.php",
                    data: "&id=" + event.id,
                    success: function (response) {
                        if (parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                            window.location.reload(); // Reload the page
                        }
                    }
                });
            }
        }
    });

    function displayMessage(message) {
        $(".response").html("<div class='success'>" + message + "</div>");
        setInterval(function () { $(".success").fadeOut(); }, 1000);
    }
});


function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>

<style>
body {
 
    font-size: 12px;
    font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
}

#calendar {
    width: 600px;
    margin: 0 auto;
}

.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;

}
/* Media query for screens smaller than 576px (phones) */
@media (max-width: 575.98px) {
  body {
    font-size: 10px; /* Decrease font size for smaller screens */
  }

  #calendar {
    /* Adjust styles for smaller screens */
    width: 90%;
    margin: 0 auto;
}
}

</style>
</head>
<body> <br> <br>
    <h2 style = "text-align: center;"> Event Management </h2>

    <div class="response"></div>
    <div id='calendar'></div>
</body>


</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .edit-form {
        display: none;
        background-color: #f2f2f2;
        border-radius: 10px;
        padding: 20px;
        margin-top: 10px;
    }

    .edit-form input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .edit-form input[type="submit"] {
        background-color: #FFD700;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .delete-button {
        background-color: #FF0000;
    }

    .edit-button {
        background-color: #FFD700;
    }
</style>
</head>


<div class="container"style="background: linear-gradient(to right, lightgray, white);">
    <h1>Event Dashboard</h1>

<style>
    /* CSS for table hover effect */
    table.table-bordered.table-striped tbody tr:hover {
        background: linear-gradient(to bottom, #a6a6a6, #a6a6a6); /* Gradient from dark gray to black on hover */
        cursor: pointer; /* Change cursor to pointer on hover */
        color: white; /* Change text color to white on hover */
    }

    /* CSS for rounded corners on table header */
    table.table-bordered.table-striped thead th {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
</style>


  <div class="container mt-5 table-container">
    <div class="table-responsive table-responsive-lg">
    <table class = "table table-bordered table-striped">
      
    <thead style="background: linear-gradient(to bottom, darkred, black);" white; border-top-left-radius: 10px; border-top-right-radius: 10px;>
            <tr>
              
                <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: maroon">ID</th>
                <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: maroon">Title</th>
                <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: maroon">Start Date</th>
                <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: maroon">End Date</th>
                <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: maroon">Edit</th>
                <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: maroon">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root"; // pangalan ng database username
            $password = ""; // yung database password
            $dbname = "admin_dashboard";//tapos name ng database na ginawa
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['action']) && $_GET['action'] == 'edit') {
                $event_id = $_GET['id'];
                $title = $_POST['title'];
                $start = $_POST['start'];
                $end = $_POST['end'];

                $sql = "UPDATE tbl_events SET title='$title', start='$start', end='$end' WHERE id=$event_id";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Event updated successfully');</script>";
                } else {
                    echo "<script>alert('Error updating event: " . $conn->error . "');</script>";
                }
            }
			
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $event_id = $_GET['id'];

    $sql = "DELETE FROM tbl_events WHERE id=$event_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Event deleted successfully');
                window.location.href = window.location.href.split('?')[0]; // Redirects to the same page without query parameters
              </script>";
        exit;
    } else {
        echo "<script>alert('Error deleting event: ". $conn->error. "');</script>";
    }
}





            // Fetch data from tbl_events
            $sql = "SELECT id, title, start, end FROM tbl_events";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['title']}</td>";
                    echo "<td>{$row['start']}</td>";
                    echo "<td>{$row['end']}</td>";
                   echo "<td><button style='background-color: #ffd700; color: black; border: none; padding: 5px 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; margin: 2px; cursor: pointer; border-radius: 10px;' onclick='showEditForm({$row['id']})'>Edit</button></td>";
echo "<td><button style='background-color: #ff0000; color: white; border: none; padding: 5px 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; margin: 2px; cursor: pointer; border-radius: 10px;' onclick='deleteEvent({$row['id']})'>Delete</button></td>";

                    echo "</tr>";

                    // Edit form
                    echo "<tr class='edit-form' id='edit-form-{$row['id']}'>";
                    echo "<td colspan='6'>";
                    echo "<form method='post' action='school_year.php?action=edit&id={$row['id']}'>";
                    echo "<input type='text' name='title' placeholder='Title' value='{$row['title']}' required><br>";
                    echo "<input type='text' name='start' placeholder='Start Date' value='{$row['start']}' required><br>";
                    echo "<input type='text' name='end' placeholder='End Date' value='{$row['end']}' required><br>";
                    echo "<input type='submit' name='edit_event' value='Update'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No events found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</div>
</div>
<script>
    function showEditForm(id) {
        var formId = 'edit-form-' + id;
        var editForm = document.getElementById(formId);
        if (editForm.style.display === 'none') {
            editForm.style.display = 'table-row';
        } else {
            editForm.style.display = 'none';
        }
    }

    function deleteEvent(id) {
        if (confirm('Are you sure you want to delete this event?')) {
            window.location.href = 'school_year.php?action=delete&id=' + id;
        }
    }
</script>

</body>
</html>
       
  
  
  
    </div>



   


<!--START OF FOOTER-->
    <footer class="main-footer text-sm">      
        <div class="float-right d-none d-sm-inline-block">
     
        </div>
    </footer>
<!--END OF FOOTER-->
    




<!-- END OF CONTENT -->  
   




<!-- actions int the  web page -->
    <script>$.widget.bridge('uibutton', $.ui.button)</script>
<!--for the sliding sidebar-->  
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
<script>
function confirmLogout() {
    var confirmLogout = confirm("Are you sure you want to logout?");
    if (confirmLogout) {
        location.replace('http://localhost/Learning%20Management%20System/adminlogin.php');
    }
}
</script>  





</body>
</html>