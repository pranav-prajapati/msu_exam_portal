<?php
include '../partials/connection.php';

error_reporting(0);
session_start();
$exam_main=$_SESSION['exam_main'];
$exam_over=$_SESSION['examover'];
$timeover=$_SESSION['timeover'];
$mouseout=$_SESSION['mouseout'];

if ($exam_over != true && $timeover!=true && $mouseout!=true) {
    echo '<script> location.replace("index.php"); </script>';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <title>DASHBOARD</title>
    <style>
  

    .container {
        box-sizing: border-box;
        min-height: 449px;

    }
    h2{
        text-transform: uppercase;
    }
h4{
    text-transform: uppercase;
}


    @media screen and (max-width: 425px) {
        h2{
        font-size:18px;
    }
    h4{
    
        font-size: 15px;

    }
      
.container a{
    font-size: 15px;
}
} 
      
      </style>
</head>

<body>
    <?php include 'student_header.php';?>

    <div class="container my-5">

        <h2>Your Exam is Over</h2>
        <hr>
        <?php
            $prn=$_SESSION['uname'];
            $subject_id=$_SESSION['subject'];

            $total=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `answer_student_mapping` WHERE subject_id=$subject_id AND student_id=$prn"));

            $current=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `answer_student_mapping` WHERE answer IS NOT NULL AND subject_id=$subject_id AND student_id=$prn"));

            echo '<h4> You have attempted <b>'.$current.'</b> questions out of <b>'.$total.'</b> questions </h4>';
            
            echo ' <a style=" color: #ffffff; text-decoration:none;" class="btn btn-info" href="paper.php?prn='.$prn.'&subject='.$subject_id.'">
            EXAM PAPER
        </a>';
            unset($_SESSION['examover']);
            unset($_SESSION['exam_main']);
            unset($_SESSION['timeover']);
            unset($_SESSION['mouseout']);
       ?>
        <hr>
        <a style=" color: #ffffff; text-decoration:none;" class="btn-lg btn-warning" href="index.php">
            END EXAM
        </a>
    </div>

    <?php include 'footer.php'; ?>

</body>

<script>

//function to avoid back button in browser
function preventBack() {
        window.history.forward();
    }

    setTimeout("preventBack()", 0);

    window.onunload = function() {
        null
    };
</script>

</html>