
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 

if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    header("Location: Teacherlogin.php");
    exit();
}

$fullname = $_SESSION["fullname"];

//db function
function getDB() {
 // Database configuration
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

    return $conn;
}

//show value to the table
function fetchData() {
    global $fullname;
    $conn = getDB(); 
    $sql = "SELECT * FROM `activity` WHERE Teachername = '$fullname'";
    $result = $conn->query($sql);
    return $result; 

}

//insertion of values multiple
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['qsubmit'])) {
  
  $title = isset($_POST['title']) ? $_POST['title'] : '';
  $class = isset($_POST['classs']) ? $_POST['classs'] : '';
  $subject = isset($_POST['sub']) ? $_POST['sub'] : '';
   $type = isset($_POST['typetest']) ? $_POST['typetest'] : '';
  $numQuestions = isset($_POST['numq']) ? $_POST['numq'] : '';
  $manswer = isset($_POST['manswer']) ? $_POST['manswer'] : '';
 


  $questions = '';
  $choices = '';
  $answers = '';

  // Loop through each question
  for ($i = 1; $i <= $numQuestions; $i++) {
      // Retrieve question, choices, and answer
      $question = isset($_POST["qns$i"]) ? $_POST["qns$i"] : '';
      $choice1 = isset($_POST["$i" . '1']) ? $_POST["$i" . '1'] : '';
      $choice2 = isset($_POST["$i" . '2']) ? $_POST["$i" . '2'] : '';
      $choice3 = isset($_POST["$i" . '3']) ? $_POST["$i" . '3'] : '';
      $choice4 = isset($_POST["$i" . '4']) ? $_POST["$i" . '4'] : '';
      $answer = isset($_POST["ans$i"]) ? $_POST["ans$i"] : '';

      // Concatenate question, choices, and answer
      $questions .= "Question $i: $question || ";
      $choices .= "$choice1 || $choice2 || $choice3 || $choice4 || ";
      $answers .= "$answer || ";
  }


  $conn = getDB(); 
  if ($conn) {
      $sql = "INSERT INTO activity (Tittle, Classs, Subject, Teachername, Quesnum, Pointpernum, Questions, Choice, Answer, Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)";
      $stmt = $conn->prepare($sql);
      if ($stmt) {
          $stmt->bind_param("ssssssssss", $title, $class, $subject, $fullname, $numQuestions, $manswer, $questions, $choices, $answers , $type);
          if ($stmt->execute()) {
              header("Location: activities.php");
              exit();
          } else {
              echo "Error: " . $stmt->error;
          }
          $stmt->close();
      } else {
          echo "Error: Unable to prepare statement.";
      }
      $conn->close();
  } else {
      echo "Error: Unable to connect to the database.";
  }
}



//insertion of values identification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['isubmit'])) {
  
  // Retrieve and convert inputs to lowercase
  $title = isset($_POST['title']) ? ($_POST['title']) : '';
  $class = isset($_POST['classs']) ? ($_POST['classs']) : '';
  $subject = isset($_POST['sub']) ? ($_POST['sub']) : '';
    $type = isset($_POST['typetest']) ? $_POST['typetest'] : '';
  $numQuestions = isset($_POST['numq']) ? ($_POST['numq']) : '';
  $manswer = isset($_POST['manswer']) ? strtolower($_POST['manswer']) : '';

  $questions = '';
  $answers = '';

  // Loop through each question and convert to lowercase
  for ($i = 1; $i <= $numQuestions; $i++) {
      $question = isset($_POST["qns$i"]) ? ($_POST["qns$i"]) : '';   
      $answer = isset($_POST["ans$i"]) ? strtolower($_POST["ans$i"]) : '';

      $questions .= "Question $i: $question || ";
      $answers .= "$answer || ";
  }

  // Database connection
  $conn = getDB(); 
  if ($conn) {
      $sql = "INSERT INTO activity (Tittle, Classs, Subject, Teachername, Quesnum, Pointpernum, Questions, Answer, Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
      $stmt = $conn->prepare($sql);
      if ($stmt) {
          $stmt->bind_param("sssssssss", $title, $class, $subject, $fullname, $numQuestions, $manswer, $questions, $answers, $type);
          if ($stmt->execute()) {
              header("Location: activities.php");
              exit();
          } else {
              echo "Error: " . $stmt->error;
          }
          $stmt->close();
      } else {
          echo "Error: Unable to prepare statement.";
      }
      $conn->close();
  } else {
      echo "Error: Unable to connect to the database.";
  }
}





//delete function
function deleteData($recordid) {
    $conn = getDB();
    $sql = "DELETE FROM `activity` WHERE Recordid = '$recordid'";
    $conn->query($sql);
    $_SESSION['error'] = 'Deleted successfully';
    header("Location: activities.php"); 
    exit(); 
}

//update function
function updateData($recordid, $title, $classs, $subject) {
    $conn = getDB();
    $sql = "UPDATE `activity` SET `Tittle`= '$title' , `Classs`='$classs', `Subject`='$subject' WHERE `Recordid`= '$recordid'";
    $conn->query($sql);
    $_SESSION['error'] = 'Updated Successfully';
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

//delete
if(isset($_GET['delete'])){
    deleteData($_GET['delete']);
}

//message
if (isset($_SESSION['error'])) {
    echo '<script>alert("'. $_SESSION['error']. '");</script>';
    unset($_SESSION['error']); 
}

//update
if(isset($_POST['update'])){
    updateData($_POST['recordid'], $_POST['updateTitle'], $_POST['updateClasss'], $_POST['updateSubject']);
}

$result = fetchData();
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
      <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm" style="font-family:georgia;background-color:rgb(18, 52, 86);
border-bottom-right-radius: 8px;border-bottom-left-radius: 8px; ">
        <!-- Left navbar -->
        <ul class="navbar-nav">
          
          <li class="nav-item d-none d-sm-inline-block">
            <a href="http://localhost/Learning%20Management%20System/3teacher/dashboard.php" class="nav-link" style="font-family:georgia;font-size:18px;color:white;">Learning Management System</a>
          </li>
        </ul>
        <!-- Right navbar  -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link"  href="http://localhost/Learning%20Management%20System/3teacher/about.php" role="button" style="color:white;"> <!--link to system info-->
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
       <div style="background-color:#573412; width: 100%; height: 46px; display: inline-block;border-bottom-right-radius: 8px;border-bottom-left-radius: 8px;"></div>
       
        <div class="sidebar  os-theme-light os-host-overflow  os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden" style="background-color:rgb( 18, 52, 86); border-radius: 8px;margin-top: -5px;">
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
                                $conn = mysqli_connect("localhost","root","","admin_dashboard") ;


                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch data from the database
                                $sql = "SELECT * FROM facultys WHERE fullname = '$fullname'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc(); // Fetch the row
                                    // Retrieve the profile picture filename
                                    $pictureFilename = $row["picture"];

                                    // Display the profile picture with circular frame and black border
                                    if (!empty($pictureFilename)) {
                                        echo '<a href="http://localhost/Learning%20Management%20System/3teacher/profilepics.php"><img src="http://localhost/Learning%20Management%20System/3teacher/profiles/' . $pictureFilename . '" alt="PROFILE PICTURE" class="img-fluid" style="max-width: 100%; height: auto; display: block; margin: 0 auto;"></a>';
                                      } else {
                                        echo '<a href="http://localhost/Learning%20Management%20System/3teacher/profilepics.php"><img src="http://localhost/Learning%20Management%20System/3teacher/profiles/default.png" alt="PROFILE PICTURE" class="img-fluid" style="max-width: 100%; height: auto; display: block; margin: 0 auto;"></a>';
                                      }
                                  } else {
                                    echo '<a href="http://localhost/Learning%20Management%20System/3teacher/profilepics.php"><img src="http://localhost/Learning%20Management%20System/3teacher/profiles/default.png" alt="PROFILE PICTURE" class="img-fluid" style="max-width: 100%; height: auto; display: block; margin: 0 auto;"></a>';
                                  }

                                // Close the database connection
                                $conn->close();
                                ?>
                            </div>
                            
                              <!-- Full name link -->
                              <div class="info">
                                  <p><a href="http://localhost/Learning%20Management%20System/3teacher/account.php" class="d-block" style="margin:7px; font-family: georgia;">
                                      <span style="display: block;"><?php echo $fullname; ?></span>
                                  </a></p>
                              </div>
              </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                   <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false" style="font-family: georgia; font-size: 14px;">
                    <li class="nav-item dropdown" >
                      <a href="http://localhost/Learning%20Management%20System/3teacher/dashboard.php" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li> 
                    <li class="nav-header">List</li>
                    <li class="nav-item dropdown" >
                      <a href="http://localhost/Learning%20Management%20System/3teacher/class.php" class="nav-link "> <!--link to class-->
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                          Class
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/3teacher/files.php" class="nav-link "><!--link to Files-->
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                          Downloadable Files
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown" style = "background-color:rgb(31, 69, 252); border-radius: 10px;">
                      <a href="http://localhost/Learning%20Management%20System/3teacher/activities.php" class="nav-link "> <!--link to activities-->
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                          Activities
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/3teacher/exam.php" class="nav-link "> <!--link to activities-->
                        <i class="nav-icon fas fa-folder-closed"></i>
                        <p>
                          Major Exam
                        </p>
                      </a>
                    </li>
                   
                    <!--maintenane part-->
                    <li class="nav-header">Maintenance</li>
                  
                    <li class="nav-item dropdown">
                      <a href="http://localhost/Learning%20Management%20System/3teacher/calendar.php" class="nav-link "> <!--link to class-->
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
 


<!-- Contains page content -->
    <div class="content-wrapper " style="min-height: 567.854px;">
       <div  >
        
          <!-- Content Header (Page header) -->
            <div class="content-header" style="background-color:darkgray; margin: 0;border-radius: 10px;">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6" >
                    <h4 class="m-0" style="font-family: georgia; font-size: 14px;">Activities -></h4>
                  </div>
                </div>
              </div>
            </div>
          <!-- end of header -->


  <style>
        @media (max-width: 576px) {
            .navbar-toggler {
                color: black;
                border-color: black;
            }
            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%280, 0, 0, 1%29' stroke-width='2' linecap='round' linejoin='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            }
        }
    </style>

           <!-- exam navigation -->
         <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#existing" data-target="qex">Existing Quiz</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#create" data-target="qcre">Add Quiz</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


            <!-- forms -->
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                
     
               <!-- existing -->
                  <div id="existing">
                      <div class="card p-3">
                          <div class="card-body">
                              <br><br>


                             

                              <!-- Table -->
                              <h3 class="text-center">Quiz</h3>
                             
                             <!--filter-->
                              <div div style="text-align: right;">
                               <!-- Filter dropdown -->
                               <label for="filterClass">Filter by Class:</label>
                               <select id="filterClass" onchange="filterTable()" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 5px; background-color: #fff; cursor: pointer;">
        <option style="padding: 8px 12px; background-color: #fff; color: #333;" value="">All Classes</option>
        
                                 <?php
                                  $conn = getDB();
                                  $sql = "SELECT DISTINCT class_name FROM class";
                                  $result_classes = $conn->query($sql);
                                  while ($row_class = $result_classes->fetch_assoc()) {
                                      echo "<option value='" . $row_class["class_name"] . "'>" . $row_class["class_name"] . "</option>";
                                  }
                                  ?>
                              </select>
                             
                              </div>

                              <style>
    /* Table styles */
    .table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }

    .table th {
        background: linear-gradient(to bottom, #4e73df 0%, #224abe 100%);
        color: white;
        font-weight: 600;
        position: relative;
    }

    .table th:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom,  #123456 20%, #4682B4 80%);
        z-index: -1;
    }

    .table th:nth-child(odd) {
      background: linear-gradient(to bottom,  #123456 20%, #4682B4 80%);
    }

    .table th:nth-child(odd):before {
      background: linear-gradient(to bottom,  #123456 20%, #4682B4 80%);
    }

    .table tbody tr:hover {
        background-color: #f9f9f9;
    }

    /* Button styles */
    .btn {
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        line-height: 1.5;
        text-align: center;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Update button */
    .btn-update {
        background-color: #007bff; /* Blue */
        color: white;
    }

    .btn-update:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }

    /* Delete button */
    .btn-delete {
        background-color: #dc3545; /* Red */
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333; /* Darker red on hover */
    }

    /* Form input styles */
    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.5;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #66afe9;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Table styles */
    .table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #f0f0f0;
}

.table th {
    background: linear-gradient(to bottom,  #123456 0%, #4682B4 100%);
    color: white;
    font-weight: 600;
    position: relative;
    border-radius: 8px 8px 0 0; /* Round top corners */
}

.table th:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom,  #123456 0%, #4682B4 80%);
    z-index: -1;
    border-radius: 8px 8px 0 0; /* Round top corners */
}

.table th:nth-child(odd) {
    background: linear-gradient(to bottom, #123456 0%, #4682B4 80%);
}

.table th:nth-child(odd):before {
    background: linear-gradient(to bottom,  #123456 0%, #4682B4 80%);
}

.table tbody tr:hover {
    background-color: #f9f9f9;
}
    /* Button styles */
    .btn {
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        line-height: 1.5;
        text-align: center;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Update button */
    .btn-update {
        background-color: #007bff; /* Blue */
        color: white;
    }

    .btn-update:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }

    /* Delete button */
    .btn-delete {
        background-color: #dc3545; /* Red */
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333; /* Darker red on hover */
    }

    /* Form input styles */
    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.5;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #66afe9;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>
<div class="container mt-5 table-container">
    <div class="table-responsive table-responsive-lg">
    
                              <table id="examTable" class="table table-bordered table-striped text-center">
                                  <thead>
                                      <tr>
                                          <th>Record Id</th>
                                          <th>Title</th>
                                          <th>Class</th>
                                          <th>Subject</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $sql = "SELECT * FROM activity WHERE Teachername = '$fullname'"; 
                                      $result_exams = $conn->query($sql);
                                      while ($row_exam = $result_exams->fetch_assoc()) {?>
                                      <tr class="classRow">
                                          <td><?= $row_exam['Recordid'];?></td>
                                          <td><?= $row_exam['Tittle'];?></td>
                                          <td><?= $row_exam['Classs'];?></td>
                                          <td><?= $row_exam['Subject'];?></td>
                                          <td>
                                              <a href="?delete=<?php echo $row_exam['Recordid'];?>" class="btn btn-danger">Delete</a>
                                              <button type="button" class="btn btn-info" onclick="showUpdateForm('<?php echo $row_exam['Recordid']; ?>', '<?php echo $row_exam['Tittle']; ?>', '<?php echo $row_exam['Classs']; ?>', '<?php echo $row_exam['Subject']; ?>')">Edit</button>
                                          </td>
                                      </tr>
                                      <?php }?>
                                  </tbody>
                            
                              </table>
</div></div>
                               <!-- Update Form -->
                              <div id="updateForm" style="display: none;">
                                  <br><br>
                                  <h3 style="text-align: center;"> Update Form </h3>
                                  <form method="post" id="updateExamForm">
                                      <input type="hidden" id="updateRecordId" name="recordid">
                                      <div class="mb-3">
                                          <label for="updateTitle" class="form-label">Title</label>
                                          <input type="text" class="form-control" id="updateTitle" name="updateTitle" required>
                                      </div>
                                      <div class="mb-3">
                                          <label for="classs" class="form-label">Class</label>
                                          <select class="form-control" id="updateClasss" name="updateClasss" style="width: 100%;" required>
                                                        <option value="">Select Class</option>
                                                        <?php
                                                        $conn = getDB();
                                                        $sql = "SELECT class FROM facultys WHERE fullname = '$fullname'";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            $classes = explode(',', $row["class"]); 
                                                            foreach ($classes as $class) {
                                                                echo "<option value='" . trim($class) . "'>" . trim($class) . "</option>"; // Trim spaces
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                      </div>
                                      <div class="mb-3">
                                          <label for="classs" class="form-label">Subject</label>
                                          <select class="form-control" id="updateSubject" name="updateSubject" style="width: 100%;" required>
                                                        <option value="">Select subject</option>
                                                        <?php
                                                        $conn = getDB();
                                                        $sql = "SELECT subject FROM facultys WHERE fullname = '$fullname'";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            $subjects = explode(',', $row["subject"]); 
                                                            foreach ($subjects as $subject) {
                                                                echo "<option value='" . trim($subject) . "'>" . trim($subject) . "</option>"; // Trim spaces
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                      </div>
                                      <input type="submit" name="update" value="Update" class="btn btn-primary">
                                  </form>
                              </div>
                              
                              <!-- Script to show update form with existing data and classfilter-->
                              <script>
                                  function showUpdateForm(recordId, title, classs,subject) {
                                      document.getElementById('updateRecordId').value = recordId;
                                      document.getElementById('updateTitle').value = title;
                                      document.getElementById('updateClasss').value = classs;
                                      document.getElementById('updateSubject').value = subject;
                                     
                                      document.getElementById('updateForm').style.display = 'block';
                                     
                                      
                                  }

</script>
<script>  
function filterTable() {
                                      var selectedClass = document.getElementById('filterClass').value;
                                      var rows = document.getElementsByClassName('classRow');

                                      for (var i = 0; i < rows.length; i++) {
                                          var row = rows[i];
                                          var classCell = row.getElementsByTagName('td')[2];
                                          if (selectedClass === '' || classCell.textContent === selectedClass) {
                                              row.style.display = '';
                                          } else {
                                              row.style.display = 'none';
                                          }
                                      }
                                  } </script>
                                 
                            


                          </div>
                      </div>
                  </div>





                  <!-- create -->
                    <div id="create" style="display: none;">
                          <br><br>
                          <div class="card p-3">
                              <legend class="border-bottom border-5 text-center">Quiz Details</legend>
                              <div class="card-body">
                                  <form method="post" action="activities.php" id="examForm">
                                      <div class="mb-3">
                                          <label for="title" class="form-label">Title</label>
                                          <input type="text" class="form-control" id="title" placeholder="Enter Quiz Title" name="title" required>
                                      </div>
                                      <div class="mb-3">
                                          <label for="classs" class="form-label">Class</label>
                                          <select class="form-control" id="classs" name="classs" style="width: 100%;" required>
                                                        <option value="">Select Class</option>
                                                        <?php
                                                        $conn = getDB();
                                                        $sql = "SELECT class FROM facultys WHERE fullname = '$fullname'";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            $classes = explode(',', $row["class"]); 
                                                            foreach ($classes as $class) {
                                                                echo "<option value='" . trim($class) . "'>" . trim($class) . "</option>"; // Trim spaces
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                      </div>
                                      <div class="mb-3">
                                          <label for="classs" class="form-label">Subject</label>
                                          <select class="form-control" id="sub" name="sub" style="width: 100%;" required>
                                                        <option value="">Select subject</option>
                                                        <?php
                                                        $conn = getDB();
                                                        $sql = "SELECT subject FROM facultys WHERE fullname = '$fullname'";
                                                        $result = $conn->query($sql);
                                                        while ($row = $result->fetch_assoc()) {
                                                            $subjects = explode(',', $row["subject"]); 
                                                            foreach ($subjects as $subject) {
                                                                echo "<option value='" . trim($subject) . "'>" . trim($subject) . "</option>"; // Trim spaces
                                                            }
                                                        }
                                                        ?>
                                                    </select>

                                      </div>
                                      <div class="mb-3">
                                          <label for="numq" class="form-label">Number of Questions</label>
                                          <input class="form-control input-md" type="number" id="numq" placeholder="Enter Number of Questions" name="numq" required>
                                      </div>
                                      <div class="mb-3">
                                          <label for="manswer" class="form-label">Marks on Right Answer</label>
                                          <input class="form-control input-md" type="number" id="manswer" placeholder="Enter Marks per Right Answer" name="manswer" required>
                                      </div>
                                       <div class="mb-3">
                                          <label for="typetest" class="form-label">Type of Test</label>
                                          <select class="form-control" id="typetest" name="typetest" style="width: 100%;" required>
                                           <option value="">Choose Type of Test</option>
                                            <option value="multiple">Multiple Choice</option>
                                            <option value="identification">Identification</option>
                                          </select>
                                      </div>

                                      <button type="button" id="nextBtn" class="btn btn-primary">Next</button>



                                      <!--questions-->
                                      <div id="questions" style="display: none;">
                                          <h3 style="text-align: center;">Questions</h3>
                                          <div id="questionFields"></div>
                                          <div class="form-group">
                                              <label class="col-md-12 control-label" for=""></label>
                                              
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                    </div>





                  <!--script for questions-->
                   <script>
                            document.getElementById('nextBtn').addEventListener('click', function() {
                                var numq = document.getElementById('numq').value;
                                var typetest = document.getElementById('typetest').value; // Get the type of test
                                var questionFields = document.getElementById('questionFields');
                                questionFields.innerHTML = ''; // Clear previous fields

                                for (var i = 1; i <= numq; i++) {
                                    if (typetest === 'multiple') {
                                        questionFields.innerHTML += '<b>Question number&nbsp;' + i + '&nbsp;:</b><br />' +
                                            // question 
                                            '<div class="form-group">' +
                                            '<label class="col-md-12 control-label" for="qns' + i + ' "></label>' +
                                            '<div class="col-md-12">' +
                                            '<textarea rows="3" cols="5" name="qns' + i + '" class="form-control" placeholder="Write question number ' + i + ' here..."></textarea>' +
                                            '</div>' +
                                            '</div>' +
                                            // options a, b, c, and d
                                            '<div class="form-group">' +
                                            '<label class="col-md-12 control-label" for="' + i + '1"></label>' +
                                            '<div class="col-md-12">' +
                                            '<input id="' + i + '1" name="' + i + '1" placeholder="Enter option a" class="form-control input-md" type="text">' +
                                            '</div>' +
                                            '</div>' +

                                            '<div class="form-group">' +
                                            '<label class="col-md-12 control-label" for="' + i + '1"></label>' +
                                            '<div class="col-md-12">' +
                                            '<input id="' + i + '2" name="' + i + '2" placeholder="Enter option b" class="form-control input-md" type="text">' +
                                            '</div>' +
                                            '</div>' +

                                            '<div class="form-group">' +
                                            '<label class="col-md-12 control-label" for="' + i + '1"></label>' +
                                            '<div class="col-md-12">' +
                                            '<input id="' + i + '3" name="' + i + '3" placeholder="Enter option c" class="form-control input-md" type="text">' +
                                            '</div>' +
                                            '</div>' +

                                            '<div class="form-group">' +
                                            '<label class="col-md-12 control-label" for="' + i + '1"></label>' +
                                            '<div class="col-md-12">' +
                                            '<input id="' + i + '4" name="' + i + '4" placeholder="Enter option d" class="form-control input-md" type="text">' +
                                            '</div>' +
                                            '</div>' +

                                            // correct answer
                                            '<br />' +
                                            '<b>Correct answer</b>:<br />' +
                                            '<select id="ans' + i + '" name="ans' + i + '" placeholder="Choose correct answer " class="form-control input-md" >' +
                                            '<option value="a">Select answer for question ' + i + '</option>' +
                                            '<option value="a"> option a</option>' +
                                            '<option value="b"> option b</option>' +
                                            '<option value="c"> option c</option>' +
                                            '<option value="d"> option d</option>' +
                                            '</select><br /><br />';
                                    } else if (typetest === 'identification') {
                                        questionFields.innerHTML += '<b>Question number&nbsp;' + i + '&nbsp;:</b><br />' +
                                            // question 
                                            '<div class="form-group">' +
                                            '<label class="col-md-12 control-label" for="qns' + i + ' "></label>' +
                                            '<div class="col-md-12">' +
                                            '<textarea rows="3" cols="5" name="qns' + i + '" class="form-control" placeholder="Write question number ' + i + ' here..."></textarea>' +
                                            '</div>' +
                                            '</div>' +
                                            // answer
                                            '<div class="form-group">' +
                                            '<label class="col-md-12 control-label" for="ans' + i + '"></label>' +
                                            '<div class="col-md-12">' +
                                            '<input id="ans' + i + '" name="ans' + i + '" placeholder="Enter the correct answer" class="form-control input-md" type="text">' +
                                            '</div>' +
                                            '</div><br /><br />';
                                    }
                                }




                                  if (typetest === 'multiple') {
                                    questionFields.innerHTML += '<div class="form-group">' +
                                        '<div class="col-md-12">' +
                                        '<input type="submit" name="qsubmit" value="Submit" style = "background-color: blue;" class="btn btn-primary" onclick="return confirm(\'Please double check before submitting, this action cannot be undone.\');">' +
                                        '</div>' +
                                        '</div>';
                                } else if (typetest === 'identification') {
                                    questionFields.innerHTML += '<div class="form-group">' +
                                        '<div class="col-md-12">' +
                                        '<input type="submit" name="isubmit" style = "background-color: blue;" value="Submit" class="btn btn-success" onclick="return confirm(\'Please double check before submitting, this action cannot be undone.\');">' +
                                        '</div>' +
                                        '</div>';
                                }


                                document.getElementById('questions').style.display = 'block';
                                 });
                        </script>





                </div>
              </div>
            </div>
            <!--end of forms-->
    </div>

           <!--togglign script-->
               <script>
                  document.addEventListener("DOMContentLoaded", function() {
                      var existing = document.getElementById('existing');
                      var create = document.getElementById('create');
                      var question = document.getElementById('questions');
                      var numqInput = document.getElementById('numq'); // Assuming numq input is in the create section

                      // Hide create and question sections by default
                      create.style.display = 'none';
                      question.style.display = 'none';

                      // Store numq value when switching to submit target
                      var numqValue = 0;

                      // Function to toggle between sections
                      function toggleSections(target) {
                          if (target === 'qcre') {
                              create.style.display = 'block';
                              existing.style.display = 'none';
                              question.style.display = 'none';
                          } else if (target === 'qex') {
                              create.style.display = 'none';
                              existing.style.display = 'block';
                              question.style.display = 'none';
                          } else if (target === 'submit') {
                          
                              create.style.display = 'block';
                              existing.style.display = 'none';
                              question.style.display = 'block';
                          }
                      }

                      // Add event listener to nav links to toggle sections
                      document.querySelectorAll('.navbar-nav a').forEach(function(link) {
                          link.addEventListener('click', function(e) {
                              e.preventDefault(); // Prevent default link behavior
                              var target = this.getAttribute('data-target'); // Get the data-target attribute of the clicked link
                              toggleSections(target);
                          });
                      });

                      // Modify the submit button event listener
                      var submitBtn = document.querySelector('input[type="submit"][name="next"]');
                      if (submitBtn) {
                          submitBtn.addEventListener('click', function(e) {
                              e.preventDefault(); // Prevent form submission
                           
                              toggleSections('submit');

                              
                          });
                      }
                  });
              </script>

</div>
          <!--START OF FOOTER-->
          <footer class="main-footer text-sm">      
              <div class="float-right d-none d-sm-inline-block">
             
              </div>
          </footer>
          <!--END OF FOOTER-->
       
        
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
        location.replace('http://localhost/Learning%20Management%20System/Teacherlogin.php');
    }
}
</script>





</body>
</html>