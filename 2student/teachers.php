<?php


// Check if the user is logged in
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    header("Location: student.php");
    exit();
}

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

// Fetch the student's ID from the session
$student_id = $_SESSION["user_id"];

// Fetch the student's exam scores
$sql = "SELECT examscores FROM student WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $examscores = array_map('trim', explode('||', $row['examscores']));
} else {
    $examscores = [];
}

// Display the student's exam scores


// Display the student's exam scores


$fullname = $_SESSION["fullname"];


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

  </head>  

  
<body class="layout-fixed layout-footer-fixed text-sm sidebar-mini control-sidebar-slide-open layout-navbar-fixed " data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto; font-family: georgia;">
   
  <div class="wrapper">
       <!-- upper bar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm" style="font-family:georgia;background-color:rgb(3, 62, 62); border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;">
        <!-- Left navbar -->
        <ul class="navbar-nav">
          
          <li class="nav-item d-none d-sm-inline-block">
            <a href="http://localhost/Learning%20Management%20System/2student/dashboard.php" class="nav-link" style="font-family:georgia;font-size:18px;color:white;">Learning Management System</a>
          </li>
        </ul>
        <!-- Right navbar  -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link"  href="http://localhost/Learning%20Management%20System/2student/about.php" role="button" style="color:white;"> <!--link to system info-->
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
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:transparent;">
        
        <!-- Sidebar -->
         <div style="background-color:rgb(55, 3, 3); width: 100%; height: 46px; display: inline-block;border-bottom-right-radius: 8px;border-bottom-left-radius: 8px;"></div>

           <div class="sidebar  os-theme-light os-host-overflow  os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden" style="background-color:rgb(3, 62, 62); border-radius: 8px;margin-top: -5px;">
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
              
              <br><br>


              
              <!-- Sidebar user panel -->
              <br>
              <br>
              <br>
               <div style="text-align: center;">
                            <!-- Profile picture -->
                            <div style="display: inline-block; text-align: center; overflow: hidden; border-radius: 50%; width: 65px; height: 65px; border: 2px solid black; margin-bottom: 10px;">
                                <?php
                                // Create connection
                                $conn = new mysqli('localhost', 'root', '', 'admin_dashboard');

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch data from the database
                                $sql = "SELECT * FROM student WHERE full_name = '$fullname'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc(); // Fetch the row
                                    // Retrieve the profile picture filename
                                    $pictureFilename = $row["picture"];

                                    // Display the profile picture with circular frame and black border
                                    if (!empty($pictureFilename)) {
                                        echo '<a href="http://localhost/Learning%20Management%20System/2student/profilepics.php"><img src="http://localhost/Learning%20Management%20System/2student/profiles/' . $pictureFilename . '" alt="PROFILE PICTURE" class="img-fluid" style="max-width: 100%; height: auto; display: block; margin: 0 auto;"></a>';
                                    } else {
                                      echo '<a href="http://localhost/Learning%20Management%20System/2student/profilepics.php"><img src="http://localhost/Learning%20Management%20System/2student/profiles/default.png" alt="PROFILE PICTURE" class="img-fluid" style="max-width: 100%; height: auto; display: block; margin: 0 auto;"></a>';
                                    }
                                } else {
                                  echo '<a href="http://localhost/Learning%20Management%20System/2student/profilepics.php"><img src="http://localhost/Learning%20Management%20System/2student/profiles/default.png" alt="PROFILE PICTURE" class="img-fluid" style="max-width: 100%; height: auto; display: block; margin: 0 auto;"></a>';
                                }

                                // Close the database connection
                               
                                ?>
                            </div>
                            
                              <!-- Full name link -->
                              <div class="info">
                                  <p><a href="http://localhost/Learning%20Management%20System/2student/account.php" class="d-block" style="margin:7px; font-family: georgia;">
                                      <span style="display: block;"><?php echo $fullname; ?></span>
                                  </a></p>
                              </div>
              </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                   <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false" style="font-family: georgia; font-size: 14px;">
                    <li class="nav-item dropdown" >
                      <a href="http://localhost/Learning%20Management%20System/2student/dashboard.php" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li> 
                    <li class="nav-header">List</li>
                    <li class="nav-item dropdown" style = "background-color:rgb(0, 124, 128);border-radius: 10px;">
                      <a href="http://localhost/Learning%20Management%20System/2student/teachers.php" class="nav-link "> 
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                          Teachers
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/2student/record.php" class="nav-link ">
                        <i class="nav-icon fas fa-file-lines"></i>
                        <p>
                          Students Record
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/2student/files.php" class="nav-link ">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                          Downloadable Files
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/2student/quiz.php" class="nav-link "> 
                        <i class="nav-icon fas fa-file-pen"></i>
                        <p>
                          Quiz
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/2student/major.php" class="nav-link "> 
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                          Major Exam
                        </p>
                      </a>
                    </li>
                   
                    <!--maintenane part-->
                    <li class="nav-header">Maintenance</li>
                  
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/2student/calendar.php" class="nav-link "> 
                        <i class="nav-icon fas fa-calendar-days"></i>
                        <p>
                          School Calendar
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
 


<div class="content-wrapper " style="min-height: 567.854px;">
       <div  >
        
          <!-- Content Header (Page header) -->
            <div class="content-header" style="background-color:darkgray; margin: 0;">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6" >
                    <h4 class="m-0" style="font-family: georgia; font-size: 14px;">Teachers -></h4>
                  </div>
                </div>
              </div>
            </div>
          <!-- end of header -->
          <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
          <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(45deg, #00008b , #006400); /* Gradient from blue to red */
        }

        h1 {
            text-align: center;
        }

        .faculty-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            
        }

        .faculty-card {
            border: 10px solid #008080;
            border-radius: 20px;
            padding: 15px;
            width: 200px;
            background-color: #add8e6 ;
          
            background-size: 100px;
            background-position: center;
            background-repeat: no-repeat, repeat;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .faculty-details {
            text-align: center;
        }

        .faculty-image {
            width: 100%;
            height: auto;
            border-radius: 40px;
            object-fit: cover;
       
        }

        /* Styling for highlighted names */
        .highlighted-name {
            color: #0C0404; /* Red color */
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            
        }
    </style>
</head>
<body>



<div class="container">
    <h1 class='highlighted-name'>Teacher  List</h1>
    <div class="faculty-container">
    
    
   <?php
// Assume the student's class is stored in a session variable
$student_class = $_SESSION["assigned_class"];

// Database connection details

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

// Fetch data from the database
$sql = "SELECT f.fullname, f.picture, f.qualification, f.department, f.class, f.subject FROM facultys f
        INNER JOIN student s ON FIND_IN_SET(s.classs, f.class) > 0
        WHERE s.classs = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_class);
$stmt->execute();
$result = $stmt->get_result();

// Array to keep track of displayed faculty members
$displayed_faculty = [];

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $fullname = $row["fullname"];
        $picture_filename_db = $row["picture"];
        $qualification = $row["qualification"];
        $department = $row["department"];
        $class = $row["class"];
        $subject = $row["subject"];
        
        // Check if this faculty member has already been displayed
        if (!in_array($fullname, $displayed_faculty)) {
            $picture_filename_folder = "../3teacher/profiles/" . $picture_filename_db;

            echo "<div class='faculty-card'>";
            if (!empty($picture_filename_db) && file_exists($picture_filename_folder)) {
                echo "<img src='$picture_filename_folder' class='faculty-image'>";
            } else {
                $default_image_path = "http://localhost/Learning%20Management%20System/2student/profiles/default.png";
                echo "<img src='$default_image_path' class='faculty-image'>";
            }
            echo "<div class='faculty-details'>";
            echo "<br><h6 class='highlighted-name' data-fullname='$fullname' data-qualification='$qualification' data-department='$department' data-class='$class' data-subject='$subject' onclick='showDetails(this)'>$fullname</h6>";
            echo "</div>";
            echo "</div>";

            // Add this faculty member to the displayed list
            $displayed_faculty[] = $fullname;
        }
    }
} else {
    echo "No faculty members found for class $student_class.";
}

// Close the connection
$conn->close();
?>

  

  </div>
</div>


<!-- Details Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modal-fullname"></h2>
            <p><strong>Qualification:</strong> <span id="modal-qualification"></span></p>
            <p><strong>Department:</strong> <span id="modal-department"></span></p>
            <p><strong>Class:</strong> <span id="modal-class"></span></p>
            <p><strong>Subject handle:</strong> <span id="modal-subject"></span></p>
        </div>
    </div>

    <style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 60px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px; /* Ensures a maximum width for larger screens */
        box-sizing: border-box; /* Ensures padding is included in the width */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .modal-content {
            width: 90%; /* More width for smaller screens */
            margin: 10% auto; /* Adjust margin for smaller screens */
        }

        .close {
            font-size: 24px; /* Adjust close button size for smaller screens */
        }
    }

    @media (max-width: 480px) {
        .modal-content {
            width: 95%; /* Even more width for very small screens */
            margin: 15% auto; /* Further adjust margin */
        }

        .close {
            font-size: 20px; /* Further adjust close button size */
        }
    }
</style>

    <script>
        function showDetails(element) {
            var fullname = element.getAttribute('data-fullname');
            var qualification = element.getAttribute('data-qualification');
            var department = element.getAttribute('data-department');
            var classs = element.getAttribute('data-class');
            var subject = element.getAttribute('data-subject');
            
            document.getElementById('modal-fullname').innerText = fullname;
            document.getElementById('modal-qualification').innerText = qualification;
            document.getElementById('modal-department').innerText = department;
            document.getElementById('modal-class').innerText = classs;
            document.getElementById('modal-subject').innerText = subject;
            
            document.getElementById('detailsModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('detailsModal').style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('detailsModal')) {
                document.getElementById('detailsModal').style.display = "none";
            }
        }
    </script>
</div>
          <!--START OF FOOTER-->
          <footer class="main-footer text-sm">      
              <div class="float-right d-none d-sm-inline-block">
             
              </div>
          </footer>
          <!--END OF FOOTER-->
       
        
</div>
</div>
  

<!-- END OF CONTENT -->  
   

<!-- actions int the  web page -->
    <script>$.widget.bridge('uibutton', $.ui.button)</script>
<!--for the sliding sidebar-->  
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
  

<script>
function confirmLogout() {
    var confirmLogout = confirm("Are you sure you want to logout?");
    if (confirmLogout) {
        location.replace('http://localhost/Learning%20Management%20System/student.php');
    }
}
</script>


</body>
</html>