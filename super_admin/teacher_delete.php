<?php 
include '../partials/connection.php';
session_start();

if(isset($_POST['id'])){
    $username= $_POST['id'];

    $sql= "DELETE FROM `user_register` WHERE `username` = '$username'";
    $result= mysqli_query($conn,$sql);
        
    $deleteteacher="DELETE FROM `subject_examiner_mapping` WHERE `examiner_code` = '$username'";
    $deleteresult=mysqli_query($conn,$deleteteacher);
        
    if($result && $deleteresult){
        echo 1;
    
    }else{
        echo mysqli_error($conn);
    }
}

