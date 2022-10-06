<?php
include '../partials/connection.php';
if(isset($_POST['ex_id'])){
    $status=$_POST['status'];
    $id=$_POST['ex_id'];
 echo $id;
   
    $query="INSERT INTO `examination_schedule`(`status`)VALUES('$status')";
    $result = mysqli_query($conn,$query);
    if($result){
     header('location:exam_schedule.php');
 
 }else{
    echo 0;
 }
}
