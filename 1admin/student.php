<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function getDB() {
  $servername = "localhost";
  $username = "root"; // pangalan ng database username
  $password = ""; // yung database password
  $dbname = "admin_dashboard";//tapos name ng database na ginawa
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  return $conn;
}

// Check if the user is logged in
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    // If not logged in, redirect to tadminlogin.phphe login page
    header("Location: adminlogin.php"); // Change this to your actual login page
    exit();
}


function insertData($full_name, $student_id, $address, $contact_no, $classs, $department, $contact_person, $contact_num, $contact_address) {
  $password = "student111"; 
  $code = null;
  $picture = '';
  $examscores = '';
  $quizscores = '';
  $conn = getDB();

  $sql = "INSERT INTO `student` (`full_name`, `Student_id`, `password`, `address`, `contact_no`, `classs`, `department`, `contact_person`, `contact_num`, `contact_address`, `code`, `picture`, `examscores`, `quizscores`)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sissssssssssss", $full_name, $student_id, $password, $address, $contact_no, $classs, $department, $contact_person, $contact_num, $contact_address, $code, $picture, $examscores, $quizscores);

  if ($stmt->execute()) {
       header("Location: student.php"); 
    exit();
  } else {
    echo "Error inserting record: " . $stmt->error;
  }

  $stmt->close();
}


function fetchData() {
     $conn = getDB();
     $sql = "SELECT * FROM `student`";
     $result = $conn->query($sql);
     return $result;
}
   
function deleteData($id) {
  $conn = getDB();
     $sql = "DELETE FROM `student` WHERE id = '$id'";
     $conn->query($sql);
       header("Location: student.php"); 
    exit();
}

function updateData( $id , $full_name , $Student_id,  $address, $contact_no, $classs, $department, $contact_person, $contact_num, $contact_address) {
  $conn = getDB();
  $sql = "UPDATE `student` SET `full_name`= '$full_name' , `Student_id`='$Student_id' ,   `address`='$address'
  , `contact_no`='$contact_no' ,`classs`='$classs' , `department`='$department' , `contact_person`='$contact_person' , `contact_num`='$contact_num'
  , `contact_address`='$contact_address' WHERE `id`= '$id'";
  $conn->query($sql);
    header("Location: student.php"); 
    exit();
}

if(isset($_POST['submit'])){
  insertData($_POST['full_name'], $_POST['student_id'] ,  $_POST['address'], $_POST['contact_no'] ,$_POST['classs'], $_POST['department'], 
  $_POST['contact_person'], $_POST['contact_num'], $_POST['contact_address']);
}

if(isset($_GET['delete'])){
  deleteData($_GET['delete']);
}

if(isset($_POST['Update'])){
  updateData($_POST['id'] ,$_POST['Full_name'], $_POST['Student_id'] ,  $_POST['Address'], $_POST['Contact_no'] ,$_POST['Classs'], $_POST['Department'], 
  $_POST['Contact_person'], $_POST['Contact_num'], $_POST['Contact_address']);
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
    
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
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


          <!-- Include Select2 CSS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

      <!-- Include jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <!-- Include Select2 JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
                    <li class="nav-item dropdown" style = "background-color:rgb(178, 24, 7); border-radius: 10px;">
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
                   
                    <li class="nav-item dropdown" >
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
                <h4 class="m-0" style="font-family: georgia; font-size: 14px;">Students -></h4>
              </div>
            </div>
          </div>
        </div>
      <!-- end of header -->
     

       <!-- add student -->
      <div class="container mt-5" >
        <div class="card p-3" style="background: linear-gradient(to right, lightgray, white);">
          <legend class="border-bottom border-5" >Add Student</legend>
          <br>
          <div class="card-body">
            <form method="post" >


<div class="mb-3">
  <label for="student_id" class="form-label">Student ID</label>
  <input type="number" class="form-control" id="student_id" placeholder="Enter Student ID" name="student_id" required min="0" step="1" oninput="this.value = this.value.slice(0, 50)">
</div>



            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="full_name" placeholder="Enter Full Name" name="full_name" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Contact no.</label>
              <input type="text" class="form-control" id="contact_no" placeholder="Enter Contact no." name="contact_no" pattern="[0-9]{11}" title="Please enter an 11-digit number" required>
            </div>
            <legend class="border-bottom border-5">Academic Information</legend> <br>
                    <!-- department -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Department</label>
                        <select class="form-control" id="department" name="department"  required>
                            <option value="">Select Department</option>
                            <?php
                             // Connect to your database
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

                            $sql = "SELECT department_name FROM departments";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["department_name"] . "'>" . $row["department_name"] . "</option>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                    </div>           
                    <!-- end of department -->
                    <!--class -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Class</label>
                        <select class="form-control" id="clsss" name="classs" required>
                            <option value="">Select Class</option>
                            <?php

                             // Connect to your database
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
                    <script>
                        $(document).ready(function() {
                            // Initialize Select2 on your select element
                            $('#clsss').select2();
                        });
                    </script>
                   <!-- end of class -->
            <legend class="border-bottom border-5">Emergency Information</legend> <br>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Emergency Contact Person</label>
              <input type="text" class="form-control" id="contact_person" placeholder="Enter Full Name" name="contact_person" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Emergency Contact no.</label>
              <input type="text" class="form-control" id="contact_num" placeholder="Enter Contact no." name="contact_num" pattern="[0-9]{11}" title="Please enter an 11-digit number" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Emergency Address</label>
              <input type="text" class="form-control" id="contact_address" placeholder="Enter Address" name="contact_address" required>
            </div>
            
            <legend class="border-upper border-5">Default Password: student111</legend> <br>           
            <input type="submit" name="submit" value="Submit" class="btn btn-primary" onclick="return checkContactNumberLengthadd()">
            </form>
          </div>
        </div>
      </div>
        <br><br><br>







      <!-- update student -->
      <div class="container mt-5" id="updateForm" style="display: none;">
        <div class="card p-3" style="background: linear-gradient(to right, lightgray, white);">
          <legend class="border-bottom border-5">Update Student Information</legend>
          <div class="card-body">
            <form method="post">
            <input type="hidden" class="form-control" placeholder="Student ID Number" name="id" id="id" readonly>
         
            
            

<div class="mb-3">
  <label for="student_id" class="form-label">Student ID</label>
  <input type="number" class="form-control" id="Student_id" placeholder="Enter Student ID" name="Student_id" required min="0" step="1" oninput="this.value = this.value.slice(0, 50)">
</div>


            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="Full_name" placeholder="Enter Last Name" name="Full_name" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Address</label>
              <input type="text" class="form-control" id="Address" placeholder="Enter Address" name="Address" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Contact no.</label>
              <input type="text" class="form-control" id="Contact_no" placeholder="Enter Contact no." name="Contact_no"  pattern="[0-9]{11}" title="Please enter an 11-digit number format 09" required>
            </div>
            <legend class="border-bottom border-5">Academic Information</legend> <br>
                        <!-- department-->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Department</label>
                            <select class="form-control" id="Department" name="Department" style="width: 100%;" required> <br>
                                  <option value="">Select Department</option>
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

                                  $sql = "SELECT department_name FROM departments";
                                  $result = $conn->query($sql);

                                  if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo "<option value='" . $row["department_name"] . "'>" . $row["department_name"] . "</option>";
                                       
                                      }
                                  } else {
                                      echo "0 results";
                                  }
                                  ?>
                              </select>
                          </div>
                          <!--end of department-->
                          <!--class-->
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label ">Class</label>             
                            <select class="form-control" id="Classs" name="Classs" style="width: 100%;" required> <br>
                                <option value="">Select Class</option>
                                <?php
                                // Connect to your database
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
                          <!--end of class-->
                          <script>
                              $(document).ready(function() {
                                  // Initialize Select2 on all select elements
                                  $('select').select2();
                              });
                          </script>

            <legend class="border-bottom border-5">Emergency Information</legend> <br>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Emergency Contact Person</label>
              <input type="text" class="form-control" id="Contact_person" placeholder="Enter Full Name" name="Contact_person" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Emergency Contact no.</label>
              <input type="text" class="form-control" id="Contact_num" placeholder="Enter Contact no." name="Contact_num"  pattern="[0-9]{11}" title="Please enter an 11-digit number format 09" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Emergency Address</label>
              <input type="text" class="form-control" id="Contact_address" placeholder="Enter Address" name="Contact_address" required>
            </div>
            <legend class="border-upper border-5">Default Password: student111</legend> <br>
            
            
            <input type="submit" name="Update" value="Update" class="btn btn-primary" onclick="return checkContactNumberLength()">
            </form>
          </div>
        </div>
      </div>


  <!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      
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

     <!-- Table -->
<div class="container mt-5">
    <table class="table table-bordered table-striped" style="text-align: center;">
    <thead style="background: linear-gradient(to bottom, darkred, black);" white; border-top-left-radius: 10px; border-top-right-radius: 10px;>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Record ID</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Student ID</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Full Name</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Address</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Contact no.</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Class</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Department</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Emergency Contact Person</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Emergency Contact Number</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Emergency Address</th>
            <th style="border-top-left-radius: 10px; border-top-right-radius: 10px; color: white">Actions</th>
        </thead>
        <tbody>
            <?php
            // Fetching data for the table
            $sql = "SELECT * FROM student"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['Student_id']; ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['contact_no']; ?></td>
                        <td><?php echo $row['classs']; ?></td>
                        <td><?php echo $row['department']; ?></td> 
                        <td><?php echo $row['contact_person']; ?></td>
                        <td><?php echo $row['contact_num']; ?></td>
                        <td><?php echo $row['contact_address']; ?></td>
                        <td>
                            <a href="#" onclick="displayUpdateForm('<?php echo $row['id'];?>', '<?php echo $row['Student_id'];?>','<?php echo $row['full_name'];?>', 
                            '<?php echo $row['address'];?>', '<?php echo $row['contact_no'];?>','<?php echo $row['classs'];?>' , '<?php echo $row['department'];?>',
                            '<?php echo $row['contact_person'];?>','<?php echo $row['contact_num'];?>' , '<?php echo $row['contact_address'];?>')" class="btn btn-warning">Update</a>
                            <a href="?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='11'>0 results</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


    <script>
    function displayUpdateForm(id, Student_id, full_name, address, contact_no, classs, department, contact_person, contact_num, contact_address) {
        document.getElementById('id').value = id;
        document.getElementById('Student_id').value = Student_id;
        document.getElementById('Full_name').value = full_name;
        document.getElementById('Address').value = address;
        document.getElementById('Contact_no').value = contact_no;
        document.getElementById('Classs').value = classs;
        document.getElementById('Department').value = department;
        document.getElementById('Contact_person').value = contact_person;
        document.getElementById('Contact_num').value = contact_num;
        document.getElementById('Contact_address').value = contact_address;

        document.getElementById('updateForm').style.display = 'block';

        }


    
        
          function checkContactNumberLength() {
              var contact_no = document.getElementById('Contact_no').value;
              var contact_num = document.getElementById('Contact_num').value;
              if (contact_no.length != 11 && contact_num.length != 11) {
                  alert("Error: Please check your Contact Number length");
                  return false; 
              } else if (contact_no.length != 11 || contact_num.length != 11) {
                  alert("Error: Please check your Contact Number length");
                  return false; 
              }
              return true; 
          }

          function checkContactNumberLengthadd() {
              var contact_no = document.getElementById('contact_no').value;
              var contact_num = document.getElementById('contact_num').value;
              if (contact_no.length != 11 && contact_num.length != 11) {
                  alert("Error: Please check your Contact Number length");
                  return false; 
              } else if (contact_no.length != 11 || contact_num.length != 11) {
                  alert("Error: Please check your Contact Number length");
                  return false; 
              }
              return true; 
          }



          
    
</script>


             



   


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