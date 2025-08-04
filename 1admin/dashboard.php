<?php
 // Start the session to access session variables

// Check if the user is logged in
if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    // If not logged in, redirect to tadminlogin.phphe login page
    header("Location: adminlogin.php"); // Change this to your actual login page
    exit();
}

// If logged in, display the admin page
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
                    <li class="nav-item dropdown" style = "background-color:rgb(178, 24, 7); border-radius: 10px;">
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
                   
                    <li class="nav-item dropdown">
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
    <div class="content-wrapper " style="min-height: 567.854px; background-image: url(http://localhost/Learning%20Management%20System/images/logo.png);background-repeat: no-repeat;  
  background-size: 40%;background-position: center;  background-blend-mode: soft-light;
    background-color: rgba(200,200,200,0.5);">
       <div  >
        
          <!-- Content Header (Page header) -->
            <div class="content-header" style="background-color:darkgray; margin: 0;border-radius: 10px;">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6" >
                    <h4 class="m-0" style="font-family: georgia; font-size: 14px;">Dashboard -></h4>
                  </div>
                </div>
              </div>
            </div>
          <!-- end of header -->
 

         <!--getting the datas in db-->
                  <?php 
                      function getDB() {
                        $servername = "localhost";
                        $username = "root"; // pangalan ng database username
                        $password = ""; // yung database password
                        $dbname = "admin_dashboard";//tapos name ng database na ginawa
                        
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        
                          return $conn;
                      }

                      
                      $conn = getDB();

                      // Check if the connection is successful
                      if ($conn) {
                          
                          $departmentQuery = "SELECT COUNT(*) as department_name FROM departments"; 
                          $classQuery = "SELECT COUNT(*) as class_name FROM class"; 
                          $teacherQuery = "SELECT COUNT(*) as employee_id FROM facultys"; 
                          $studentQuery = "SELECT COUNT(*) as Student_id FROM student"; 
                          $result = $conn->query($departmentQuery); 

                          if ($result) { // Checking if the query executed successfully
                              $row = $result->fetch_assoc(); // Fetching the result row
                              $depnum = $row['department_name']; // Storing the count of departments
                              $result->free(); // Freeing the result set
                              
                              $result = $conn->query($classQuery); 
                              $row = $result->fetch_assoc(); 
                              $classnum = $row['class_name']; 
                              $result->free();

                              $result = $conn->query($teacherQuery); 
                              $row = $result->fetch_assoc(); 
                              $teachernum = $row['employee_id']; 
                              $result->free();

                              $result = $conn->query($studentQuery); 
                              $row = $result->fetch_assoc(); 
                              $studentnum = $row['Student_id']; 
                              $result->free();
                          } else {
                              
                              echo "Error executing query: " . $conn->error;
                          }
                      } else {
                          
                          echo "Failed to connect to the database.";
                      }
                  ?>
          <!-- data retrieving end-->


          <!--Center Content-->
      
          <br><br><br>
          
<style>
    .info-card {
        border: 1px solid rgba(0, 120, 120, 0.6);
        padding: 20px;
        margin-bottom: 30px;
        text-align: center;
        transition: all 0.3s ease-in-out;
        border-radius: 10px;
          background: linear-gradient(to bottom, rgba(143, 11, 11, 0.9), rgba(150, 85, 20, 0.9)); /* Gradient from dark red to darker salmon with 0.9 visibility */
    }

    .info-card:hover {
        transform: translateY(-5px);
    }

    .icon {
        font-size: 70px;
        color: white;
        margin-bottom: 20px;
    }

    .info h2 {
        font-family: Georgia, serif;
        font-size: 60px;
        margin-bottom: 10px;
        color: white;
    }

    .info p {
        font-size: 18px;
        color: white;
    }

    @media (max-width: 768px) {
        .info-card {
            margin-bottom: 20px;
        }
    }
</style>





<div class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-cssgrid">
    <div class="grid text-center">               
      <div class="g-col-6 info-card" > <!-- Maroon color with 80% transparency -->
        <div style="display: inline-block;" >
          <i class="fa-solid fa-building icon"></i>
          <div class="info">
            <h2><?php echo isset($depnum) ? $depnum : 'N/A'; ?></h2>
            <p>Total Departments</p>
          </div>
        </div>                            
      </div>




     <div class="g-col-6 info-card" > <!-- Maroon color with 80% transparency -->
    <div style="display: inline-block;">
        <i class="fa-solid fa-users icon"></i>
        <div class="info">
            <h2><?php echo isset($classnum) ? $classnum : 'N/A'; ?></h2>
            <p>Total Classes</p>
        </div>
    </div>                            
</div>

<div class="g-col-6 info-card" >
    <div style="display: inline-block;">
        <i class="fa-solid fa-user-tie icon"></i>
        <div class="info">
            <h2><?php echo isset($teachernum) ? $teachernum : 'N/A'; ?></h2>
            <p>Total Instructors</p>
        </div>
    </div>                            
</div>

      <div class="g-col-6 info-card" >
    <div style="display: inline-block;">
        <i class="fa-solid fa-user-graduate icon"></i>
        <div class="info">
            <h2><?php echo isset($studentnum) ? $studentnum : 'N/A'; ?></h2>
            <p>Total Students</p>
        </div>
    </div>                            
</div>



<!--START OF FOOTER-->
<footer class="main-footer text-sm" style = "background-color: darkgray;">      
    <div class="float-right d-none d-sm-inline-block">
   
    </div>
</footer>
<!--END OF FOOTER-->



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
