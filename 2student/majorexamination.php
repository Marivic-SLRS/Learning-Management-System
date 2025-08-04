
<?php



if (!isset($_SESSION["username"]) || empty($_SESSION["username"])) {

    header("Location: student.php"); 
    exit();
}


$fullname = $_SESSION["fullname"];
$class = $_SESSION["assigned_class"];
$exam_title = isset($_GET['tittle']) ? $_GET['tittle'] : '';
$subject = isset($_GET['subject']) ? $_GET['subject'] : '';
$teachername = isset($_GET['teachername']) ? $_GET['teachername'] : '';
$recordid = isset($_GET['exam_id']) ? $_GET['exam_id'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$point = isset($_GET['point']) ? $_GET['point'] : '';


//all
function handleFormSubmission() {
 

    $conn = new mysqli('localhost', 'root', '', 'admin_dashboard');

$theans = "";


//concat the answers multiple
if (isset($_POST['msubmit'])) {
    // Initialize $theans as an empty string
    $theans = '';

    // Loop through each question
    foreach ($_POST as $key => $value) {
        // Check if the key starts with 'question_' (indicating it's a question)
        if (strpos($key, 'question_') !== false) {
            // Append the selected answer to $theans
            $theans .= ($value === '') ? 'e' : $value . " || ";
        }
    }

    // Call the function to get the score
    getscore($theans, $conn);
}


//concat the answers identification
if (isset($_POST['isubmit'])) {
    $theans = '';

    foreach ($_POST as $key => $value) {
        // Check if the key starts with 'answer' (indicating it's an answer)
        if (strpos($key, 'answer') === 0) {
            if (is_array($value)) {
                // If $value is an array (e.g., from checkboxes), implode and lowercase each value
                $value = implode(' || ', array_map('strtolower', $value)); 
            } else {
                // Lowercase the value
                $value = strtolower($value);
            }
          
            // Append the lowercase answer to $theans, or 'e' if the value is empty
            $theans .= ($value === '') ? 'e' : $value;
            $theans .= " || "; 
        }
    }

    // Call the function to get the score
    igetscore($theans, $conn);
}





}


//submit multiple
function getscore($selectedAnswers, $conn){ 
  global $exam_title;
  global $class;
  global $subject;
  global $fullname;
  global $teachername;

  $sql = "SELECT answer , pointpernum FROM major WHERE tittle = '$exam_title' AND classs = '$class' AND subject = '$subject'";
  $result = $conn->query($sql); 

  if ($result) {
    $row = $result->fetch_assoc(); 
    $dbanswer = $row['answer']; 

    $right = explode(' || ', $dbanswer);
    $studentans = explode(' || ', $selectedAnswers);

    $score = 0;

    // Compare each answer
   for ($i = 0; $i < count($right); $i++) {
      if ($right[$i] == $studentans[$i]) {
        $score++;
      }
    }


    //compute the score
    $points = $row['pointpernum']; 
    $pointpernum = (int)$points;
    $score = ($score-1) * $pointpernum;
    $score = str_pad($score, 4, '0', STR_PAD_LEFT);


  


    //score to insert
    $sco = (string)$score;
    $finalscore = $sco . " " . $exam_title . " - " . $subject. " || ";


            $insertion = "UPDATE student SET examscores = CONCAT(IFNULL(examscores, ''), ?) WHERE full_name = ?";
            $stmt = $conn->prepare($insertion);
            
            // Check if the statement was prepared successfully
            if ($stmt === false) {
                $_SESSION['error'] = "Error preparing statement: " . $conn->error;
            } else {
                // Bind parameters
                $stmt->bind_param("ss", $finalscore, $fullname);
            
                // Execute the statement
                if ($stmt->execute()) {
                  
                  // echo 'Your Score: '. $score; 
                   $_SESSION['score'] = $score;




                   $_SESSION["fullname"] =$fullname ;
                    $_SESSION["assigned_class"]= $class ;
                    $_SESSION['exam_title'] = $exam_title;
                    $_SESSION['Subject'] =$subject;
                    $_SESSION['Teacher'] =$teachername;


                   header('Location: examscore.php');
                   exit();
                   
                } else {
                    $_SESSION['error'] = "Error updating score: " . $stmt->error;
                    
                }

              

            }
    
}

}



//submit identification
function igetscore($selectedAnswers, $conn){ 
  global $exam_title;
  global $class;
  global $subject;
  global $fullname;
  global $teachername;

  $sql = "SELECT answer , pointpernum FROM major WHERE tittle = '$exam_title' AND classs = '$class' AND subject = '$subject'";
  $result = $conn->query($sql); 

  if ($result) {
    $row = $result->fetch_assoc(); 
    $dbanswer = $row['answer']; 

    $right = explode(' || ', $dbanswer);
    $studentans = explode(' || ', $selectedAnswers);

    $score = 0;

    // Compare each answer
   for ($i = 0; $i < count($right); $i++) {
      if ($right[$i] == $studentans[$i]) {
        $score++;
      }
    }


    //compute the score
    $points = $row['pointpernum']; 
    $pointpernum = (int)$points;
    $score = ($score-1) * $pointpernum;
    $score = str_pad($score, 4, '0', STR_PAD_LEFT);


  


    //score to insert
    $sco = (string)$score;
    $finalscore = $sco . " " . $exam_title . " - " . $subject. " || ";


            $insertion = "UPDATE student SET examscores = CONCAT(IFNULL(examscores, ''), ?) WHERE full_name = ?";
            $stmt = $conn->prepare($insertion);
            
            // Check if the statement was prepared successfully
            if ($stmt === false) {
                $_SESSION['error'] = "Error preparing statement: " . $conn->error;
            } else {
                // Bind parameters
                $stmt->bind_param("ss", $finalscore, $fullname);
            
                // Execute the statement
                if ($stmt->execute()) {
                  
                  // echo 'Your Score: '. $score; 
                   $_SESSION['score'] = $score;




                   $_SESSION["fullname"] =$fullname ;
                    $_SESSION["assigned_class"]= $class ;
                    $_SESSION['exam_title'] = $exam_title;
                    $_SESSION['Subject'] =$subject;
                    $_SESSION['Teacher'] =$teachername;


                   header('Location: examscore.php');
                   exit();
                   
                } else {
                    $_SESSION['error'] = "Error updating score: " . $stmt->error;
                    
                }

              

            }
    
}

}




handleFormSubmission();


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
            text-align: left;
            background-color: #25383C; 
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
       <p style = "font-family: sans-serif;margin:0%;">Point/s per Number: <?php echo $point; ?></p>
      <p style = "font-family: sans-serif;">Teacher: <?php echo $teachername; ?></p>

<!--answer form-->
<div class="color" id="answer_form">
<?php

$servername = "localhost";
$username = "root"; // pangalan ng database username
$password = ""; // yung database password
$dbname = "admin_dashboard";//tapos name ng database na ginawa

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM major WHERE Recordid = '$recordid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {   

       while ($row = $result->fetch_assoc()) {
        // Check the type of the activity
        $type = strtolower($row["type"]);
        
        if ($type === "multiple") {
            // Multiple choice form
            $questions = explode(' || ', $row["questions"]);
            $choices = explode(' || ', $row["choice"]);
            
            if (!empty($questions) && !empty($choices)) { // Check if questions and choices exist
                echo '<form method="post">';
                echo '<div class="question-card">';
                for ($i = 0; $i < count($questions); $i++) {
                    echo '<div class="question-title">' . $questions[$i] . '</div>';
                    echo '<div class="question-choices">';
                    echo '<div class="choices-list">';
                    
                    // Determine the number of choices for this question
                    $choiceCount = min(4, count($choices) - ($i * 4)); // Calculate the remaining choices
                    
                    for ($j = 0; $j < $choiceCount; $j++) {
                        $optionIndex = ($i * 4) + $j; // Calculate the index of the current choice
                        if ($choices[$optionIndex] !== "") { // Check if the choice is not empty
                            $option = strtolower(chr(97 + $j)); // Convert to a, b, c, d
                            echo '<label><input type="radio" name="question_' . ($i + 1) . '" value="' . $option . '" required> ' . $option . '. ' . $choices[$optionIndex] . '</label><br>';
                        }
                    }
                    
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
                echo '<button style="display: inline-block;background-color:white;float:right;" class="nav-link" name="msubmit">Submit</button>';
                echo '</form>';
            } else {
                echo "No questions found for the specified teacher.";
            }
        } else if ($type === "identification") {
 
    $questions_raw = explode(' || ', $row["questions"]);

    $questions = [];

 
    for ($i = 0; $i < count($questions_raw); $i += 1) {
        if (isset($questions_raw[$i + 1])) {
            $questions[] = [
                'question' => $questions_raw[$i],
                'input_type' => $questions_raw[$i + 1]
            ];
        }
    }

    if (!empty($questions)) { 
        echo '<form method="post">';
        echo '<div class="question-card">';
        
   
        foreach ($questions as $index => $q) {
            echo '<div class="question-title">' . htmlspecialchars($q['question']) . '</div>';
            echo '<div class="question-answer">';
            
            
            switch ($q['input_type']) {
                case 'text':
                    echo '<input type="text" name="answer' . $index . '" class="form-control" placeholder="Your answer" required><br>';
                    break;
                case 'radio':

                    // Example: "What is your gender? (Male,Female,Other) || radio"
                    $options = explode(',', substr($q['question'], strpos($q['question'], '(') + 1, -1));
                    foreach ($options as $option) {
                        echo '<input type="radio" name="answer' . $index . '" value="' . htmlspecialchars($option) . '" required> ' . htmlspecialchars($option) . '<br>';
                    }
                    break;
                case 'checkbox':
                    // Similarly, handling checkbox options
                    $options = explode(',', substr($q['question'], strpos($q['question'], '(') + 1, -1));
                    foreach ($options as $option) {
                        echo '<input type="checkbox" name="answer' . $index . '[]" value="' . htmlspecialchars($option) . '"> ' . htmlspecialchars($option) . '<br>';
                    }
                    break;
                // Add more cases for different input types if needed
                default:
                    echo '<input type="text" name="answer' . $index . '" class="form-control" placeholder="Your answer" required><br>';
            }

            echo '</div>';
        }

        echo '</div>';
        echo '<button style="display:inline-block;background-color:white;float:right;" class="nav-link" name="isubmit">Submit</button>';
        echo '</form>';
    } else {
        echo "No questions found for the specified teacher.";
    }
}

       }
}


   
 
            $conn->close();
            ?>
            </div>


</bod>
</html>
