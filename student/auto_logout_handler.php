<?php
include '../partials/connection.php';
session_start();


$startTime=$_SESSION['starttime'];
$duration=$_SESSION['exam_duration'];
$subject_id=$_SESSION['subject'];
$prn=$_SESSION['uname'];



date_default_timezone_set("Asia/Kolkata");

$time = strtotime($startTime);
$endTime = date("h:i a", strtotime('+'.$duration.' minutes', $time));


if(isset($_POST['logout'])){
    if(date("h:i a")==$endTime || date("h:i a")>$endTime ){

        echo 'logout';

        $_SESSION['timeover']=true;

        $updatesql="UPDATE `examination_schedule` SET `exam_status` = '0' WHERE `examination_schedule`.`subject_id` = $subject_id";

        $updateresult=mysqli_query($conn,$updatesql);


        $logouttime="UPDATE `student_images` SET `logout_time` = NOW() WHERE `student_images`.`prn` = $prn AND `student_images`.`subject_id`=$subject_id" ;
        $updatelogouttime=mysqli_query($conn,$logouttime);

        }
}




?>