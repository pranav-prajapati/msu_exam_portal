<?php
include "../partials/connection.php";
session_start();


$sub_name=mysqli_real_escape_string($conn,$_POST['sub_name']);
$sub_category=mysqli_real_escape_string($conn,$_POST['sub_category']);
$sub_code= mysqli_real_escape_string($conn,$_POST['sub_code']);
$year=mysqli_real_escape_string($conn,$_POST['year']);
$faculty_id=mysqli_real_escape_string($conn,$_SESSION['faculty']);
$department_id=mysqli_real_escape_string($conn,$_POST['department']);
$degree_id=mysqli_real_escape_string($conn,$_POST['degree']);
$sub_credit=mysqli_real_escape_string($conn,$_POST['sub_credit']);





    $existsql="SELECT * FROM `subject_register` WHERE subject_name='$sub_name' OR subject_code='$sub_code' ";
    $result=mysqli_query($conn,$existsql);

    $num=mysqli_num_rows($result);
    
    

    if($num > 0){
        echo 2;
    }

    else{
        $sql="INSERT INTO `subject_register` (`subject_name`, `subject_category`, `subject_code`,`faculty_id`,`department_id`,`year`,`degree_id`,`credit`) 
        VALUES ('$sub_name', '$sub_category', '$sub_code','$faculty_id','$department_id','$year','$degree_id','$sub_credit')";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
          
           echo 1;
        
        }
        else
        {
          echo 0;
        
        }
    }


?>