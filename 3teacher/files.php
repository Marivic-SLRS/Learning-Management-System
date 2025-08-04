
<?php


//db connection
$servername = "localhost";
$username = "root"; // pangalan ng database username
$password = ""; // yung database password
$dbname = "admin_dashboard";//tapos name ng database na ginawa

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



//gettings the username
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    
    header("Location: Teacherlogin.php"); 
    exit();    
}

//showing the name
$fullname = $_SESSION["fullname"];


//for showing files data in the tables ehe
if(isset($conn) && $conn !== null) {
  $sql = "SELECT * FROM files";
  $result = $conn->query($sql);

  if ($result !== false) {
     
  } else {
      echo "Error executing query: " . $conn->error;
  }
} else {
  echo "Connection is not properly established.";
}


//delete and upload
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //update
  if (isset($_POST['recordid']) && isset($_POST['class_filter'])) {
    $recordid = $_POST['recordid'];
    $class_filter = $_POST['class_filter'];

    // Call the update function
    updateData($recordid, $class_filter);

    // Redirect to the same page after update
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
    
  // delete
  if (isset($_POST['delete']) && isset($_POST['code'])) {
      $delete_id = $_POST['delete'];
      $user_code = $_POST['Code'];

  
      $sql_fetch = "SELECT code FROM files WHERE id = ?";
      $stmt = $conn->prepare($sql_fetch);
      $stmt->bind_param("i", $delete_id);
      $stmt->execute();
      $result_fetch = $stmt->get_result();

      if ($result_fetch->num_rows > 0) {
          $row = $result_fetch->fetch_assoc();
          $code_from_db = $row["code"];


          if ($user_code == $code_from_db) {

              $sql_delete = "DELETE FROM files WHERE id = ?";
              $stmt = $conn->prepare($sql_delete);
              $stmt->bind_param("i", $delete_id);

              if ($stmt->execute()) {
                  $_SESSION['error'] = 'Record deleted successfully';
              } else {
                  $_SESSION['error'] = 'Error deleting record: ' . $conn->error;
              }
          } else {
              $_SESSION['error'] = 'Incorrect code. Deletion aborted.';
          }
      } else {
          $_SESSION['error'] = 'No record found for the given ID';
      }


      header("Location: " . $_SERVER['REQUEST_URI']); //para pa irefresh hindi uulit ung process
      exit();
  }
  //end of delete
  // upload
  if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  
    $allowed_types = array("pdf");
    if (!in_array($file_type, $allowed_types)) {
        $_SESSION['error'] = 'Sorry, only PDF files are allowed.';
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

            $filename = $_FILES["file"]["name"];
            $filesize = $_FILES["file"]["size"];
            $filetype = $_FILES["file"]["type"];         
            $class_name = $_POST['classs']; 
            
            $code = $class_name . " " . "@111"; 

         
            $sql = "INSERT INTO files (filename, filesize, filetype, code, class_name, teachername) VALUES ('$filename', $filesize, '$filetype', '$code', '$class_name' , '$fullname')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['error'] = 'The file has been uploaded and the information has been stored in the database.';                 
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            } else {                
                $_SESSION['error'] = 'Sorry, there was an error storing information in the database: ' . $conn->error;              
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        } else {           
             $_SESSION['error'] = 'Sorry, there was an error moving the uploaded file.\nDebugging information: ' . $_FILES["file"]["error"];  
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }
    }
} else {
    $_SESSION['error'] = 'No file Uploaded';                 
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
  //end  of upload
}


//update data
function updateData($recordid, $class_filter) {
 //db connection
 $servername = "localhost";
 $username = "root"; // pangalan ng database username
 $password = ""; // yung database password
 $dbname = "admin_dashboard";//tapos name ng database na ginawa
 
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 

$code = $class_filter ." ". "@111";

  // Prepare the update query
  $sql = "UPDATE `files` SET `class_name`= '$class_filter' , `code`= '$code'   WHERE `id`= '$recordid'";

  // Execute the update query
  if ($conn->query($sql) === TRUE) {
      $_SESSION['error'] = 'Record updated successfully';
  } else {
      $_SESSION['error'] = 'Error updating record: ' . $conn->error;
  }
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
                                
$conn = new mysqli('localhost', 'root', '', 'admin_dashboard');



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
                    <li class="nav-item dropdown" style = "background-color:rgb(31, 69, 252); border-radius: 10px;">
                      <a href="http://localhost/Learning%20Management%20System/3teacher/files.php" class="nav-link "><!--link to Files-->
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                          Downloadable Files
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
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
          <!-- Content Header (Page header) -->
            <div class="content-header" style="background-color:darkgray; margin: 0;border-radius: 10px;">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6" >
                    <h4 class="m-0" style="font-family: georgia; font-size: 14px;">Downloadable Files -></h4>
                  </div>
                </div>
              </div>
            </div>
          <!-- end of header -->
 
<div class="container mt-5" style="max-width: 1200px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: rgba(0,0,0,0);">
          
        <!--upload form-->
          <form id="uploadForm" style="display: none; padding: 20px; border: 1px solid #ddd; border-radius: 5px; background-color: #f5f5f5;" method="POST" enctype="multipart/form-data">
              <h2 style="margin-bottom: 20px; color: #333;">Upload a file</h2>
              <div class="mb-3">
                  <label for="file" class="form-label">Select file</label>
                  <input type="file" class="form-control" name="file" id="file">
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Class</label>             
                  <select class="form-control" id="classs" name="classs" style="width: 100%;" required>
                      <option value="">Select Class</option>
                      <?php
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

                      $sql = "SELECT class_name FROM class";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                              echo "<option value='" . $row["class_name"] . "'>" . $row["class_name"] . "</option>";
                          }
                      } else {
                          echo "0 results";
                      }
                      ?>
                  </select>
              </div>
              <label style="margin-bottom: 10px; display: block; color: #666;">File Code: [class]@111</label>
              <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">Upload file</button>
          </form>






         <!-- update form-->
          <div class="container mt-5" id="updateForm" style="display: none;">
              <form method="POST">
                  <h2>Update Form</h2>
                  <div class="mb-3">
                  <input type="hidden" class="form-control" placeholder="Record id" name="recordid" id="recordid" readonly>
                      <label class="form-label">Update Class Name</label>
                      <div class= "mb-3">
                      <select id="class_filter" name="class_filter" style="width: 100%;"  class="form-control">
                            <option value="">All Classes</option>
                                    <?php          
                                    $sql = "SELECT * FROM class";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='". $row['class_name']. "'>". $row['class_name']. "</option>";
                                        }
                                    }
                                  ?>
                      </select>
                      </div>
                  </div>
                  <button type="submit" name="Update" value="Update"  class="btn btn-primary">Update</button>
              </form>
          </div>



<!-- table for file -->
<div class="container mt-5">
    <h2>Uploaded Files</h2>
    
    
    <div style="text-align: right;">
    <form method="GET" style="display: inline-block;">
        <label for="class_filter" style="margin-right: 10px;">Filter by Class:</label>
        <select id="class_filter" name="class_filter" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 5px; background-color: #fff; cursor: pointer; appearance: none;">
            <option style="padding: 8px 12px; background-color: #fff; color: #333; border-bottom: 1px solid #ccc;" value="">All Classes</option>
            <?php
            $sql = "SELECT * FROM class";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option style='padding: 8px 12px; background-color: #fff; color: #333; border-bottom: 1px solid #ccc; margin-right: 5px;' value='". $row['class_name']. "'>". $row['class_name']. "</option>";
                }
            }
            ?>
        </select>
        <button type="submit" class="btn btn-primary" style="padding: 5px 10px; background-color: #007bff; color: white; border-radius: 10px;">Filter</button>
        <a style="padding: 5px 10px; background-color: #007bff; color: white; border-radius: 10px; cursor: pointer;" id="showUploadForm">+</a>
    </form>
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





<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      
      
<div class="container mt-5 table-container">
    <div class="table-responsive table-responsive-lg">
    <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Record Id</th>
            <th>File Name</th>
            <th>File Size</th>
            <th>File Type</th>
            <th>Class</th>
            <th>Download</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if $conn is set and not null before using it
        if (isset($conn) && $conn!== null) {
            // Get the filtered class from the GET request
            $class_filter = $_GET['class_filter']?? '';

            // Proceed with executing the SQL query
            $sql = "SELECT * FROM files WHERE teachername = '$fullname'";
            if (!empty($class_filter)) {
                $sql .= " AND class_name = '$class_filter'";
            }

            $result = $conn->query($sql);

            // Check if the query was successful
            if ($result!== false) {
                // Display the uploaded files and download links
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file_path = "uploads/". $row['filename'];
        ?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['filename'];?></td>
                            <td><?php echo $row['filesize'];?> bytes</td>
                            <td><?php echo $row['filetype'];?></td>
                            <td><?php echo $row['class_name'];?></td>
                            <td><a href="<?php echo $file_path;?>" class="btn btn-primary" download>Download</a></td>
                            <td>
                                <div class="text-right">
                                    <form method="POST" action="">
                                        <input type="hidden" name="code" value="<?php echo $row['id'];?>">
                                        <input type="text" class="form-control" name="Code" placeholder="File Code">
                                        <button type="submit" name="delete" value="<?php echo $row['id'];?>" class="btn btn-danger">Delete</button>
                                        <button type="button" name="update" onclick="updateClass('<?php echo $row['id'];?>', '<?php echo $row['class_name'];?>', '<?php echo $row['code'];?>')" value="<?php echo $row['id'];?>" class="btn btn-info">Update</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
        <?php
                    }
                } else {
        ?>
                    <tr>
                        <td colspan="7">No files uploaded yet.</td>
                    </tr>
        <?php
                }
            } else {
                echo "Error executing query: ". $conn->error;
            }
        } else {
            echo "Connection is not properly established.";
        }
        ?>
    </tbody>
</table>

</div>
<br>
<br>
<br>
</div>
          <!--START OF FOOTER-->
          <footer class="main-footer text-sm">      
              <div class="float-right d-none d-sm-inline-block">
             
              </div>
          </footer>
          <!--END OF FOOTER-->
       
        
</div>


<script> 
function updateClass(id, class_name, dbcode) { 
  console.log('working'); 
  console.log('id:', id); 
  console.log('class_name:', class_name); 
  console.log('dbcode:', dbcode); 
  
  
  document.getElementById('recordid').value = id; 
  document.getElementById('class_filter').value = class_name; 
  
  
   
  const row = event.target.closest('tr');
  const codeElement = row.querySelector('input[name="Code"]'); 
  
  if (codeElement) { 
    var code = codeElement.value; console.log('code:', code); 
    
    if (code === dbcode) { 
      console.log('Code matches, showing the update form'); 
      document.getElementById('updateForm').style.display = 'block'; 
    } else { 
      console.log('Code does not match'); 
      alert("Incorrect File Code."); 
      document.getElementById('updateForm').style.display = 'none'; 
      
    }
 } else { 
  console.log('Code element not found'); 
  
  } 
  } 
  </script>






    <script>
    // JavaScript to toggle visibility of upload form
    document.getElementById('showUploadForm').addEventListener('click', function() {
        var uploadForm = document.getElementById('uploadForm');
        if (uploadForm.style.display === 'none') {
            uploadForm.style.display = 'block';
        } else {
            uploadForm.style.display = 'none';
        }
    });
</script>

  

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