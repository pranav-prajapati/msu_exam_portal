<?php
include '../partials/connection.php';
session_start();


$student_id=$_SESSION['uname'];
$subject_id=$_SESSION['subject'];

if(isset($_POST['mouseout'])){
    
    $sql="INSERT INTO `block_list` (`student_id`, `subject_id`) VALUES ('$student_id', '$subject_id')";
    $result=mysqli_query($conn,$sql);

    if($result){
        $_SESSION['mouseout']=true;

        $logouttime="UPDATE `student_images` SET `logout_time` = NOW() WHERE `student_images`.`prn` = $student_id AND `student_images`.`subject_id`=$subject_id" ;
        $updatelogouttime=mysqli_query($conn,$logouttime);


        echo 'logout';
    }
}


?>