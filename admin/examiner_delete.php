<?php 
include '../partials/connection.php';
session_start();

if(isset($_POST['id'])){
    $ex_id= $_POST['id'];

    $sql= "DELETE FROM `subject_examiner_mapping` WHERE `id` = '$ex_id'";
    $result= mysqli_query($conn,$sql);
        
        
    if($result){
        echo 1;
    
    }else{
        echo 0;
    }
}

?>