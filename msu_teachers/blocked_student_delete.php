<?php 
include '../partials/connection.php';
session_start();

if(isset($_POST['id'])){
    $student_id= $_POST['id'];

    $sql= "DELETE FROM `block_list` WHERE `student_id` = '$student_id'";
    $result= mysqli_query($conn,$sql);
        
    
    if($result){
        echo 1;
    
    }else{
        echo mysqli_error($conn);
    }
}

?>