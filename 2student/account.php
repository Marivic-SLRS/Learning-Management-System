
<?php



if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {

    header("Location: student.php"); 
    exit();
}


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
                    <li class="nav-item dropdown" >
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
 


<!-- Contains page content -->
    <div class="content-wrapper " style="min-height: 567.854px;">
       <div  >
        
          <!-- Content Header (Page header) -->
            <div class="content-header" style="background-color:darkgray; margin: 0;border-radius: 10px;">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6" >
                    <h4 class="m-0" style="font-family: georgia; font-size: 14px;">Manage Account-></h4>
                  </div>
                </div>
              </div>
            </div>
          <!-- end of header -->
 


          <!--content-->
<div class="container">
  <div class="row justify-content-center">
            
        </div>
        <br><br>
        <h3 style="text-align: center;">Account Information</h3>
        <br><br>
        <div class="mb-3">
            <label for="Student_id" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="Student_id" value="<?php echo $row['Student_id']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" value="<?php echo $row['password']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" value="<?php echo $row['full_name']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" value="<?php echo $row['code']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="classs" class="form-label">Class</label>
            <input type="text" class="form-control" id="classs" value="<?php echo $row['classs']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_person" class="form-label">Contact Person</label>
            <input type="text" class="form-control" id="contact_person" value="<?php echo $row['contact_person']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_num" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_num" value="<?php echo $row['contact_num']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="contact_address" class="form-label">Contact Address</label>
            <input type="text" class="form-control" id="contact_address" value="<?php echo $row['contact_address']; ?>" readonly>
        </div>

        <div class="d-grid gap-2">
            <a href="http://localhost/Learning%20Management%20System/2student/edit.php" class="btn btn-primary">Edit</a>
        </div>
        <br><br><br>
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
        location.replace('http://localhost/Learning%20Management%20System/student.php');
    }
}
</script>





</body>
</html>