<?php
include '../partials/connection.php';
session_start();

if(isset($_POST['subject_name'])){
    $subname=$_POST['subject_name'];
    $department_id=$_SESSION['department'];
    $year=mysqli_real_escape_string($conn,$_POST['year']);
    $date=mysqli_real_escape_string($conn,$_POST['date']);
    $time=mysqli_real_escape_string($conn,$_POST['time']);
    $minute=mysqli_real_escape_string($conn,$_POST['minute']);
    $slot=mysqli_real_escape_string($conn,$_POST['slot']);
    
    $existsql="SELECT * FROM `examination_schedule` WHERE subject_id='$subname'";
    $existresult=mysqli_query($conn,$existsql);

    $num=mysqli_num_rows($existresult);

    if($num==0){

        $query="INSERT INTO examination_schedule (`subject_id`,`department_id`,`year`,`exam_date`,`exam_time`,`exam_duration`,`exam_status`,`slot_id`) VALUES('$subname','$department_id','$year',' $date','$time','$minute','0','$slot')";

        $result=mysqli_query($conn,$query);

        if($result){
            echo 1;
        }
    }
    else{
        echo 0;
    }


    
    
}
