<?php

include '../partials/connection.php';
session_start();

$option=mysqli_real_escape_string($conn,$_POST['options']);
$questionid=$_POST['question_id'];
$prn=$_SESSION['uname'];
$count=$_POST['count'];

// echo $option."<br>";
// echo $questionid."<br>";
// echo $prn;

$sql="UPDATE answer_student_mapping SET answer='$option' WHERE question_id = $questionid AND student_id=$prn";
$result=mysqli_query($conn,$sql);


if($result){
    echo '<script> 
    
            location.replace("/msu_exam_portal/student/exam_main.php"); 
    
    
          </script>';

}


?>