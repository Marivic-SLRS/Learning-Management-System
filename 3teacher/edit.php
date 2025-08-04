
<?php


if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {
    header("Location: Teacherlogin.php"); 
    exit();
}

$fullname = $_SESSION["fullname"];


$servername = "localhost";
$username = "root"; // pangalan ng database username
$password = ""; // yung database password
$dbname = "admin_dashboard";//tapos name ng database na ginawa

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    
    $employee_id = isset($_POST["employee_id"]) ? $_POST["employee_id"] : null;
    $password = isset($_POST["npassword"]) ? $_POST["npassword"] : null;
    $fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : null;
    $code= isset($_POST["code"]) ? $_POST["code"] : null;
    $address = isset($_POST["address"]) ? $_POST["address"] : null;
    $contact_no = isset($_POST["contact_no"]) ? $_POST["contact_no"] : null;
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : null;
    $qualification = isset($_POST["qualification"]) ? $_POST["qualification"] : null;
    $emergency_person = isset($_POST["emergency_person"]) ? $_POST["emergency_person"] : null;
    $emergency_num = isset($_POST["emergency_num"]) ? $_POST["emergency_num"] : null;
    $confirmpass = isset($_POST["cpassword"]) ? $_POST["cpassword"] : null;
    

    if (strlen($contact_no) == 11 && strlen($emergency_num) == 11){

              if ($confirmpass == $password){

                $sql = "UPDATE facultys SET password=?, fullname=?, code=?, address=?, contact_no=?, gender=?, qualification=?, emergency_person=?, emergency_num=? WHERE employee_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssisssssss", $password, $fullname, $code, $address, $contact_no, $gender, $qualification, $emergency_person, $emergency_num, $employee_id);
            
                if ($stmt->execute()) {
                    $_SESSION['error'] = 'Record updated successfully';
                    
                  
                   
                } else  {
                    $_SESSION['error'] = 'Error updating record: ' . $conn->error;
                  
                }

                
              } else {
                $_SESSION['error'] = 'Password do not match.';

              }
     


    } else if ((strlen($contact_no) == 11 && strlen($emergency_num) != 11) || (strlen($contact_no) != 11 && strlen($emergency_num) == 11) || (strlen($contact_no) != 11 && strlen($emergency_num) != 11)) {
      $_SESSION['error'] = 'Mobile Numbers should not exceed 11 Digits format 09.';
    }
    
   header("Location: edit.php");
   exit();
}

$sql = "SELECT * FROM facultys WHERE fullname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fullname);
$stmt->execute();
$result = $stmt->get_result();

// Result
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // You can retrieve data and display it here
    }
}

// Display error message
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
                    <li class="nav-item dropdown">
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
 <style>
    .invalid-feedback {
      display: none;
      color: red;
    }
    input:invalid + .invalid-feedback {
      display: block;
    }
  </style>
           
           

 <!-- Contains page content -->
<div class="content-wrapper" style="min-height: 567.854px;">
    <div>

      
        <!-- Content Header (Page header) -->
        <div class="content-header " style="background-color: darkgray; margin: 0;border-radius: 10px;">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 "> <!-- Center align content -->
                        <h4 class="m-0" style="font-family: georgia; font-size: 14px;">Manage Account -></h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of header -->

        <div class="container-fluid">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">


                <!-- Your HTML form here -->
                <form method="POST" action="edit.php">
                    <!-- Include a hidden field to carry the employee_id -->
                    <input type="hidden" name="employee_id" value="<?php echo $row['employee_id']; ?>">
                    <!-- Your existing input fields here -->
                    <br>
                    <br>                 
                    <h3 style = "text-align: center;">Update Account Information</h3><br><br>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $row['fullname']; ?>" required placeholder="Please enter your full name" readonly>
                    </div>                
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>"required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_no" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="contact_no" value="<?php echo $row['contact_no']; ?>" minlength="11" maxlength="11" pattern=".{11,11}"required>
                         <div class="invalid-feedback">
                       Mobile numbers should be 11 digits.
                      </div>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" value="<?php echo $row['gender']; ?>"required>
                                  <option value="">Select Gender</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>                               
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qualification" class="form-label">Qualification</label>
                        <select class="form-select" name="qualification"required>
                                  <option value="">Select qualification</option>
                                  <option value="Licensed Teacher">Licensed Teacher</option>
                                  <option value="Bachelor Holder">Bachelor Degree Holder</option>
                                  <option value="Master Degree Holder">Master Degree Holder</option>
                                  <option value="Doctoral Degree Holder">Doctoral Degree Holder</option>
                                  <option value="Other">Other</option>
                        </select>
                    </div>
                    
                    
                   
                    <div class="mb-3">
                        <label for="emergency_person" class="form-label">Emergency Person</label>
                        <input type="text" class="form-control" name="emergency_person" value="<?php echo $row['emergency_person']; ?>"required>
                    </div>
                    <div class="mb-3">
                        <label for="emergency_num" class="form-label">Emergency Number</label>
                        <input type="text" class="form-control" name="emergency_num" value="<?php echo $row['emergency_num']; ?>"  minlength="11" maxlength="11" pattern=".{11,11}"required>
                         <div class="invalid-feedback">
                           Mobile numbers should be 11 digits.
                          </div>
                    </div>
                    
                     <div class="mb-3">
                        <label for="password" class="form-label">Current Password</label>
                        <input type="text" class="form-control" name="password" id="password" value="<?php echo $row['password']; ?>" readonly>
                      
                    </div> 
                    
                    
                     <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="npassword" id="npassword" required>
                        <p style ="font-size:12px;font-style:normal;"><input type="checkbox" onclick="myFunction1()">Show Password</p>
                    </div> 
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword"  id="cpassword" required>
                          <p  style ="font-size:12px;font-style:normal;"><input type="checkbox" onclick="myFunction2()">Show Password</p>
                    </div>  
                    
                    
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" name="code" value="<?php echo $row['code']; ?>"  minlength="6" maxlength="6" pattern=".{6,6}" required>
                         <div class="invalid-feedback">
                          Code must be 6 digits.
                          </div>
                    </div>
                    
                    
                    <!-- Update button -->
                    <div class="d-grid gap-2">
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                    <br><br>
                </form>
                <!-- End of HTML form -->
            </div>
        </div>
    </div>
</div>



      </div>
</div>



<!-- END OF CONTENT -->

<!-- actions in the web page -->
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



    
 <script>
function myFunction1() {
    var x = document.getElementById("npassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>


  <script>
function myFunction2() {
    var x = document.getElementById("cpassword");
   
    
    if (x.type === "password") {
        x.type = "text";
      
    } else {
        x.type = "password";
      
    }
}
</script>


        
  </body>
  </html>  

           

        

  

  